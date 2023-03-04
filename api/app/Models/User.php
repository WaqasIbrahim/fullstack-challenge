<?php

namespace App\Models;

use App\Services\OpenWeatherService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function weather(): HasOne
    {
        return $this->hasOne(Weather::class);
    }

    public function updateWeather()
    {
        $weatherService = new OpenWeatherService();
        $data = $weatherService->getWeather($this->latitude, $this->longitude);

        if (! $data) {
            Log::alert('Failed to fetch weather data for user '.$this->name);

            return;
        }

        $this->weather()->updateOrCreate([], $data);
    }
}
