<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return response()->json($categories);
    }

    public function item_by_category($id)
    {
        $category = Category::with('items')->find($id);

        return response()->json($category);
    }
}
