<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return response()->json($categories,200);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->only(['name','description','icon']));
        return response()->json($category,201);
    }

    public function show(Category $category)
    {
        return response()->json($category,200);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->only(['name','description','icon']));
        return response()->json($category,201);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null,204);
    }

}
