<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id', 'amount'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
