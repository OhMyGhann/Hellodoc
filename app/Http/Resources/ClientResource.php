<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_account_id' => $this->user_account_id,
            'doctor_id' => $this->doctor_id,
            'is_review_anonymous' => $this->is_review_anonymous,
            'wait_time_rating' => $this->wait_time_rating,
            'bedside_manner_rating' => $this->bedside_manner_rating,
            'overall_rating' => $this->overall_rating,
            'review' => $this->review,
            'is_doctor_recommended' => $this->is_doctor_recommended,
            'review_date' => $this->review_date,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
