<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Visualcrossing\Weather\Client;

class WeatherVisualController
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function currentTemperature(Request $request)
    {

        $response = $this->client->make()->to($request->city);

        /* Add Query to response or ['include'=>'days'] and more options */
        $temperature = $response->addQuery(['include'=>'current'])->get();

        echo $temperature['currentConditions']['temp'];

        dd($temperature);

    }

}
