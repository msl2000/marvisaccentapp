<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'teams',
            'id' => $this->id,
            'attributes' => [
                'id' => $this->id,
                'product_name' => $this->product_name,
                'date' => $this->date,
                'sales_person' => $this->sales_person,
                'customer_name' => $this->customer_name,
                'price' => $this->product->price,
            ],
            'links' => [
                'self' => [
                    'href' => self::getSelfLink($this),
                ],
            ],
        ];
    }

    public static function getSelfLink($item)
    {
        return action('SaleController@show', ['sale' => $item->id]);
    }
}
