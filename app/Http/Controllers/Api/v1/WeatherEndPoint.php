<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\WeatherResource;
use App\Models\Weather as WeatherModel;
use \Illuminate\Http\JsonResponse;


class WeatherEndPoint extends ApiController
{
    /**
     * @return JsonResponse
     */

    public function getAll(): JsonResponse
    {
        return $this->sendResponse(new WeatherResource(WeatherModel::all()), 'Retrieved Successfully.');
    }
}
