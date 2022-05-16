<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;

class WeatherController extends Controller
{
    use ApiResponseTrait;

    public function getWeatherData(){
        $appId = 'f7b7aeb090fe9579d0d43a07baad7d26';
        $position = Location::get('156.217.200.255');
        $lat = $position->latitude;
        $lon = $position->longitude;
        $url = 'https://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lon.'&appid='.$appId;
        $response = Http::get($url);

        $weather = Weather::create([
            'city' => $response['name'],
            'lat' => $response['coord']['lat'],
            'lon' => $response['coord']['lon'],
            'country' => $response['sys']['country'],
        ]);
        //return $response['name'];
        return $this->returnResponseData('data',$response->json(),'success','200');

    }
}
