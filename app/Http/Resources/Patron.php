<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Patron extends JsonResource
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
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'date_of_birth' => $this->date_of_birth,
            'expected_renew_date' => $this->expected_renew_date,
            'subscription_type_id' => $this->subscription_type_id,
        ];
    }
}
