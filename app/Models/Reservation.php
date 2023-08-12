<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id', 'name', 'pin', 'status'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function order_items()
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }
}
