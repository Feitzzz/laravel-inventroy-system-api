<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Product;
use App\Models\Sale;

class SaleController extends Controller
{
    public function createSale(CreateSaleRequest $request)
    {
        $validatedData = $request->validated();

        // Check stock availability for all products first
        foreach ($validatedData['products'] as $productData) {
            $product = Product::findOrFail($productData['id']);
            if ($product->stock_quantity < $productData['quantity']) {
                return response()->json([
                    'message' => "Product: {$product->name} does not have enough stock. Available: {$product->stock_quantity}",
                ], 422);
            }
        }

        // Calculate total for all products
        $total = 0;
        foreach ($validatedData['products'] as $productData) {
            $product = Product::findOrFail($productData['id']);
            $total += $productData['quantity'] * $product->price;
        }

        // Create the sale
        $sale = Sale::create([
            'user_id'     => auth()->user()->id,
            'customer_id' => $validatedData['customer_id'],
            'total'       => $total,
        ]);

        // Attach products and update stock
        foreach ($validatedData['products'] as $productData) {
            $product = Product::findOrFail($productData['id']);

            // Attach product to sale
            $sale->products()->attach($product->id, [
                'quantity' => $productData['quantity'],
                'price'    => $product->price,
            ]);

            // Update stock
            $product->stock_quantity -= $productData['quantity'];
            $product->save();
        }

        return response()->json([
            'message' => 'Sale created successfully',
            'sale'    => new SaleResource($sale),
        ], 201);
    }

    public function getSales()
    {
        $sales = Sale::with(['customer', 'user', 'products'])->get();
        return SaleResource::collection($sales);
    }

    public function getSale(Sale $sale)
    {
        return new SaleResource($sale);
    }
}
