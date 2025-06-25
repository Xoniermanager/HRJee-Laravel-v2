<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignTaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user_end_status' => $this->user_end_status,
            'final_status' => $this->final_status,
            'completed_at' => $this->completed_at,
            'created_at' => $this->created_at,
            'visit_location' => [
                'latitude' => $this->visit_address_latitude,
                'longitude' => $this->visit_address_longitude,
            ],
            'completed_location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],
        ];
    }
}

