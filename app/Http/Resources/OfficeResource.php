<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'doctor_id' => $this->doctor_id,
            'hospital_affiliation_id' => $this->hospital_affiliation_id,
            'time_slot_per_client_in_min' => $this->time_slot_per_client_in_min,
            'first_consultation_fee' => $this->first_consultation_fee,
            'followup_consultation_fee' => $this->followup_consultation_fee,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip' => $this->zip,
            // 'hospital' => new HospitalResource($this->whenLoaded('hospital')),
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
