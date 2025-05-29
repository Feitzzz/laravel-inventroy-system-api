<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => 'sometimes|required|string|max:255',
            'stock_quantity' => 'sometimes|required|integer|min:0',
            'description'    => 'sometimes|required|string|max:1000',
            'price'          => 'sometimes|required|numeric|min:0',
            'category_id'    => 'sometimes|required|exists:categories,id',
        ];
    }
}
