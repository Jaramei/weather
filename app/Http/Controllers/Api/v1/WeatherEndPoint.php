<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\WeatherResource;
use App\Models\Weather as WeatherModel;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Visualcrossing\Weather\Client;


class WeatherEndPoint extends ApiController
{
    /**
     * @var
     */
    protected Client $client;

    public function __construct(Client $client) {

        $this->client = $client;

    }

    /**
     * @return JsonResponse
     */

    public function getAll(): JsonResponse
    {
        return $this->sendResponse(new WeatherResource(WeatherModel::all()), 'Retrieved Successfully.');
    }

    /**
     * @return JsonResponse
     */

    public function getCity(Request $request): JsonResponse
    {

        $response = $this->client->make()->to($request->city);
        $temperature = $response->addQuery(['include'=>'current'])->get();

        return $this->sendResponse($temperature,'200');

    }

}
