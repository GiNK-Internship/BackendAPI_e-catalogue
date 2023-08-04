<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::with('reservation')->get();
        return response()->json($tables);
    }

    public function detail($id)
    {
        $table = Table::findOrFail($id);
        return response()->json($table);
    }

    public function table_active($id)
    {
        $table = Table::find($id)->reservation()->where('status', 'Process')->with('items')->with('table')->get();

        return response()->json($table);
    }

    public function history_by_table($id)
    {
        $table = Table::find($id)->reservation()->with('items')->with('table')->get();

        return response()->json($table);
    }

    public function reservation()
    {
        $tables = Table::with('reservation')->get();
        return response()->json($tables);
    }
}
