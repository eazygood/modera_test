<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index() {
    	return Category::all();
    }

    public function show(Category $category) {
    	return $category;
    }

    public function showByName($name) {
    	$categoryName = Category::where('name','like', '%' . $name . '%')->get();
    	return response()->json($categoryName, 200);
    }

    public function showSubcategory($id) {
    	$subCategory = Category::find($id)->subcategory()->get();
    	return response()->json($subCategory, 200);
    }

    public function store(Request $request) {
    	$category = Category::create($request->all());
    	return response()->json($category, 201);
    }

    public function update(Request $request , Category $category) {
			$category->update($request->all());
			return response()->json($category, 200);
    }

    public function delete(Category $category) {
    	$category->delete();
			return response()->json(null, 204);
    }

}
