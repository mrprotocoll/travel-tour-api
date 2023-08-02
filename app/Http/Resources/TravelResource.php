<?php

namespace App\Http\Resources;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Travel
 */
class TravelResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'numberOfDays' => $this->number_of_days,
            'numberOfNights' => $this->number_of_nights,
            'slug' => $this->slug,
        ];
    }
}
