<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('categories')->get();

        return response()->json($items);
    }

    public function store(Request $request)
    {
        $image = null;

        if ($request->file) {
            $fileName = Str::random(20);;
            $extension = $request->file->extension();
            $image = $fileName . '.' . $extension;
            Storage::putFileAs('image', $request->file, $image);
        }

        $request['foto'] = $image;
        $item = Item::create($request->all());

        return response()->json($item);
    }

    public function detail($id)
    {
        $item = Item::findOrFail($id);

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->update($request->except('foto'));

        if ($request->hasFile('foto')) {
            Storage::delete('images' . $item->foto);

            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move('images', $fotoName);
            $item->foto = $fotoName;

            $item->save();
        }

        return response()->json($item);
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id)->delete();

        return response()->json($item);
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
