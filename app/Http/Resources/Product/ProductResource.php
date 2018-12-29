<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Storage;
class ProductResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->details,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'stock'=>$this->stock,
            'rating'=>round($this->reviews->sum('star')/$this->reviews->count()),
            'href'=>[
                'review'=>route('reviews.index',$this->id),
            ]

        ];
    }
}
