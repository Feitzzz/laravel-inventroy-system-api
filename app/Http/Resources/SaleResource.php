<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'customer'   => [
                'id'    => $this->customer->id,
                'name'  => $this->customer->name,
                'email' => $this->customer->email,
            ],
            'user'       => [
                'id'   => $this->user->id,
                'name' => $this->user->name,
            ],
            'total'      => $this->total,
            'created_at' => $this->created_at,
            'products'   => $this->products->map(function ($product) {
                return [
                    'id'       => $product->id,
                    'name'     => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'price'    => $product->pivot->price,
                ];
            }),
        ];
    }
}
