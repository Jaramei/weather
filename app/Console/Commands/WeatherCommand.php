<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Weather;

class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wheater:current {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the temperatures in the city';

    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        $service = new WeatherCommand();
        $service->getCurrentCity($this->argument('city'));
        return $service['currentConditions']['temp'];

        /** Artisan::call('wheater:current poznan'); */

    }
}
