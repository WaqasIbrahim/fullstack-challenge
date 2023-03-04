<?php

namespace App\Console\Commands;

use App\Jobs\UpdateUserWeather;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class UpdateUsersWeatherCommand extends Command
{
    protected $signature = 'users:update-weather';

    protected $description = 'Queue update weather jobs for users';

    public function handle(): int
    {
        // Get users with missing weather data or stale data
        $users = User::doesntHave('weather')
            ->orWhereHas('weather', function (Builder $query) {
                $query->where('updated_at', '<=', now()->subMinutes(30));
            })->get();

        $this->withProgressBar($users, function (User $user) {
            UpdateUserWeather::dispatch($user);
        });

        return Command::SUCCESS;
    }
}
