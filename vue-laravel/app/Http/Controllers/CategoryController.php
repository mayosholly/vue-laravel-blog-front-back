<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $category = Category::get();
        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Successfully Fetched'
        ], 201);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required| unique:categories'
        ]);
        $category = new Category($validated);
        $category->save();
        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Successfully Created'
        ]);

    }

    public function show(Request $request,  Category $category){
        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'A Category'
        ]);
    }

    
    public function update(Request $request, Category $category){
        $validated = $request->validate([
            'name' => 'required ',
        ]);
        $category->update($validated);
        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Successfully Updated'
        ]);

    }

    public function destroy(Request $request, Category $category){
        $category->delete();
        return response()->json([
            'success' => true,
            'data' => '',
            'message' => 'Successfully Deleted'
        ]);


    }

}
