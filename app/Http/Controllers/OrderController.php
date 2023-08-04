<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function update(Request $request, $id)
    {
        $orders = OrderItem::findOrFail($id);
        $orders->update(['quantity_delivered' => $request->quantity_delivered]);

        return new OrderResource($orders->loadMissing(['item:id,name']));
    }

    public function store(Request $request)
    {
        $reservationId = $request->input('reservation_id');
        $items = $request->input('items');

        $orderAmount = 0;

        foreach ($items as $itemData) {
            $orderAmount += $itemData['price'] * $itemData['quantity_order'];
        }

        $order = Order::create([
            'reservation_id' => $reservationId,
            'amount' => $orderAmount,
        ]);

        $orderId = $order->id;

        $delivered = $request['quantity_delivered'] = 0;
        foreach ($items as $itemData) {
            OrderItem::create([
                'reservation_id' => $reservationId,
                'order_id' => $orderId,
                'item_id' => $itemData['item_id'],
                'quantity_order' => $itemData['quantity_order'],
                'quantity_delivered' => $delivered,
                'price' => $itemData['price'],
                'name' => $itemData['name'],
                'notes' => $itemData['notes'],
            ]);
        }

        return response()->json(['message' => 'Data order item berhasil ditambahkan', 'amount' => $orderAmount], 201);
    }
}
