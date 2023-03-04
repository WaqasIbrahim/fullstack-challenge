<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateUserWeather implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public $timeout = 60;

    public $failOnTimeout = true;

    public $uniqueFor = 24 * 60 * 60;

    public function __construct(private User $user)
    {
        //
    }

    public function uniqueId()
    {
        return $this->user->id;
    }

    public function handle(): void
    {
        $this->user->updateWeather();
    }
}
