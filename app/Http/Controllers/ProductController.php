<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request)
    {
        $validatedData = $request->validated();
        $product       = Product::Create([
            'name'           => $validatedData['name'],
            'description'    => $validatedData['description'],
            'price'          => $validatedData['price'],
            'category_id'    => $validatedData['category_id'],
            'stock_quantity' => $validatedData['stock_quantity'],
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => new ProductResource($product),
        ], 201);
    }

    public function getProduct(Product $product)
    {
        $product->load('category.user');

        return response()->json([
            'product' => new ProductResource($product),
        ]);
    }

    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $product->update($validatedData);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => new ProductResource($product),
        ], 200);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ], 200);
    }
}
