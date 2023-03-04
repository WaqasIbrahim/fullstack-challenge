<?php

/**
 * A better approach would be to use bulk download from OpenWeather if we
 * have a large number of users. We will need to parse the JSON file in chunks and
 * map user location. It would mean more processing on our end but it will reduce API calls
 * to the service by many times.
 *
 * https://openweathermap.org/bulk
 */

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherService
{
    private const API_URL = 'https://api.openweathermap.org/data/2.5/weather';

    private const ICON_URL = 'http://openweathermap.org/img/wn/%s@2x.png';

    public function getWeather(string $latitude, string $longitude)
    {
        $response = Http::acceptJson()->get(self::API_URL, [
            'appid' => config('openweather.api_key'),
            'lat' => $latitude,
            'lon' => $longitude,
            'units' => 'metric',
        ]);

        if (! $response->ok()) {
            return null;
        }

        $data = $response->json();

        return [
            'location' => ! empty($data['name']) ? $data['name'] : null,
            'country_code' => $data['sys']['country'] ?? null,
            'condition' => $data['weather'][0]['main'],
            'description' => $data['weather'][0]['description'],
            'temperature' => $data['main']['temp'],
            'temperature_feels_like' => $data['main']['feels_like'],
            'temperature_min' => $data['main']['temp_min'],
            'temperature_max' => $data['main']['temp_max'],
            'icon_url' => sprintf(self::ICON_URL, $data['weather'][0]['icon']),
        ];
    }
}
