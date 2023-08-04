<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'item' => $this->whenLoaded('item'),
            'quantity_order' => $this->quantity_order,
            'quantity_delivered' => $this->quantity_delivered,
            'price' => $this->price,
            'name' => $this->name,
            'notes' => $this->notes,
        ];
    }
}
