<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class subscribe extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'website_id' => $this->website_id,
            'created_at' => $this->created_at,
        ];
    }
}
