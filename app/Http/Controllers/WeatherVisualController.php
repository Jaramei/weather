<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Visualcrossing\Weather\Client;

class WeatherVisualController
{
    protected Client $client;


    /**
     * @var
     */
    private array $temperature;

    public function __construct(Client $client, $temperature)
    {
        $this->client = $client;
        $this->temperature = $temperature;

    }

    public function currentTemperature(Request $request)
    {

        $response = $this->client->make()->to($request->city);

        /* Add Query to response or ['include'=>'days'] and more options */
        $this->temperature = $response->addQuery(['include'=>'current'])->get();

        echo $this->temperature['currentConditions']['temp'];

        dd($this->temperature);

    }

}
