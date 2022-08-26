<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Models\Weather as WeatherModel;


class Weather
{

    /**
     * @var mixed | String
     *
     */

   private $baseUri;

    /**
     * @var mixed | String
     *
     */
    private $apiKey;

    /**
     * @var
     */
    private $service;

    public function __construct()
   {

       $this->baseUri = Config('weather.baseUrl');
       $this->apiKey = Config('weather.apiKey');

   }

    protected function getClient(): Client
    {

       $this->service = new Client([
           'timeout' => 10,
       ]);

       return $this->service;

   }

   public function getCurrentCity($city)
   {

       /* Var $city is Root Validation */

       $this->getClient();

       $request = $this->service->request('GET',$this->baseUri.'/'.$city,[

           RequestOptions::QUERY =>[
               'unitGroup'=>'metric',
               'key'=>$this->apiKey,
               'contentType'=>'json',
               ]
       ]);

       if ($request->getStatusCode() == 200)
       {

           return json_decode($request->getBody(), true);
       }

   }

   public function save($request,$temperature)
   {

       $db = new WeatherModel();
       $db->city = $request->city;
       $db->temperature = $temperature;
       $db->ip = $request->ip();
       $db->save();

   }

}
