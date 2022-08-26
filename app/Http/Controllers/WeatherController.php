<?php

namespace App\Http\Controllers;


use App\Services\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{

    private Weather $service;

    public function __construct(Weather $service)
    {
        $this->service = $service;

    }

    public function index(Request $request)
    {

        $result = $this->service->getCurrentCity($request->city);
        $this->service->save($request,$result['currentConditions']['temp']);

        echo $result['currentConditions']['temp'];

    }

}


