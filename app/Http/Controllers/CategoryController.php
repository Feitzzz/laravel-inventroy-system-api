<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function createCategory(CreateCategoryRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::create([
            'name'        => $validatedData['name'],
            'description' => $validatedData['description'],
            'user_id'     => auth()->user()->id,
        ]);

        return response()->json([
            'message'  => 'Category created successfully',
            'category' => new CategoryResource($category),
        ], 201);
    }

    public function updateCategory(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
        $category->update($validatedData);

        return response()->json([
            'message'  => 'Category updated successfully',
            'category' => new CategoryResource($category),
        ], 200);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ], 200);
    }
}
