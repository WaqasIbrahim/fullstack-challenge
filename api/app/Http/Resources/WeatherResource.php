<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'location' => [
                'name' => $this->location,
                'countryCode' => $this->country_code,
            ],
            'condition' => $this->condition,
            'description' => $this->description,
            'iconUrl' => $this->icon_url,
            'temperature' => [
                'value' => $this->temperature,
                'feelsLike' => $this->temperature_feels_like,
                'min' => $this->temperature_min,
                'max' => $this->temperature_max,
            ],
            'updatedAt' => $this->updated_at,
        ];
    }
}
