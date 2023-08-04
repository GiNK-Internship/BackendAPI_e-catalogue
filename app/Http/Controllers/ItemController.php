<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('categories')->get();

        return response()->json($items);
    }

    public function detail($id)
    {
        $item = Item::findOrFail($id);

        return response()->json($item);
    }
}
