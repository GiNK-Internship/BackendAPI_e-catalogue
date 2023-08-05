<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('status', 'Process')->with('table')->get();
        return response()->json($reservations);
    }

    public function detail($id)
    {
        $table = Table::find($id)->reservation()->with('items')->with('table')->orderBy('created_at', 'desc')->where('status', 'Process')->first();
        if ($table == null) {
            $table = Table::find($id);
            $data = [
                'id' => 0,
                'table_id' => $table['id'],
                'name' => '',
                'pin' => '',
                'status' => 'Finish',
                'created_at' => '',
                'updated_at' => '',
                'items' => [],
                'table' => $table
            ];

            $table = (object)$data;
        }

        return response()->json($table);
    }


    public function detail_item_reservations($id)
    {
        $reservation = Reservation::with('items')->with('table')->find($id);
        return response()->json($reservation);
    }

    public function registration($id)
    {
        $table = Table::findOrFail($id);
        return response()->json($table);
    }

    public function generate(Request $request, $id)
    {
        $generate_pin = strval(random_int(1000, 9999));

        $request['table_id'] = $id;
        $request['pin'] = $generate_pin;
        $request['status'] = "Process";

        $reservation = Reservation::create($request->all());

        return $reservation;
    }

    public function update_status(Request $request, $id)
    {
        $request['status'] = 'Finish';

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return $reservation;
    }

    public function check_login(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation['name'] == $request['name'] && $reservation['pin'] == $request['pin']) {
            return response()->json($reservation);
        } else {
            return response()->json(['error' => 'Nama atau PIN salah'], 401);
        }
    }

    public function checkout($id, Request $request)
    {
        $id_table = $request->table_id;

        $table = Table::find($id_table);
        $table->status = 'Kosong';
        $table->save();

        $reservation = Reservation::find($id);
        $reservation->status = 'Finish';
        $reservation->save();

        $table = Table::find($id_table)->reservation()->with('items')->with('table')->orderBy('created_at', 'desc')->where('status', 'Finish')->first();

        return response()->json($table);
    }
}
