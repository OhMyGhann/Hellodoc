<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'user_account_id' => new ClientAccountResource($this->whenLoaded('client_account')),
            'office' => $this->office,
            'probable_start_time' => $this->probable_start_time,
            'actual_end_time' => $this->actual_end_time,
            'status'=> $this->status,
            'appointment_taken_date'=> $this->appointment_taken_date,
            'app_booking_channel_id'=> new ClientAccountResource($this->whenLoaded('app_booking_channel')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
