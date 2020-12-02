<?php

namespace Anax\Service;

use Anax\Ipstack\Ipstack;

/**
 * A plain service class with no dependencies.
 */
class WeatherService
{
    private $message = null;



    public function setMessage(string $message) : void
    {
        $this->message = $message;
    }

    public function useService() : string
    {
        return "This service loads a message from the config file.<br>&gt; '{$this->message}'";
    }

    public function getWeather($cIp, $cLat, $cLon)
    {
        $keyArray = include(__DIR__ . '/../../config/api_keys.php');
        
        $stack = new Ipstack();
        $lat = $cLat;
        $lon = $cLon;
        if (($cLat == null || $cLon == null) && $cIp != null) {
            $response = $stack->getIpInfo($cIp, $keyArray["keys"]["ipstack"]);
            $lat = $response["latitude"];
            $lon = $response["longitude"];
        }

        $query = "https://api.openweathermap.org/data/2.5/forecast?lat=". $lat . "&lon=".  $lon . "&appid=" . $keyArray["keys"]["weather"];

        if ($lat != null && $lon != null) {
            $res = file_get_contents($query) ?? null;
        }
        $info = json_decode($res ?? null, true);

        if ($info == null) {
            $info = ["error" => "Ingen info hittades för angivna ip/koordinater"];
        }

        return ["weather" => $info, "ip" => $response];
    }
    
    public function getWeatherThroughCurl($cIp, $cLat, $cLon) : array
    {
        $keyArray = include(__DIR__ . '/../../config/api_keys.php');
        var_dump($keyArray);
        $stack = new Ipstack();
        $lat = $cLat;
        $lon = $cLon;
        if (($cLat == null || $cLon == null) && $cIp != null) {
            $response = $stack->getIpInfo($cIp, $keyArray["keys"]["ipstack"]);
            $lat = $response["latitude"];
            $lon = $response["longitude"];
        }
        $dt = time() - 432000;
        $url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=". $lat . "&lon=".  $lon . "&dt=" . $dt . "&appid=" . $keyArray["keys"]["weather"];

        //  Initiate curl handler
        $ch = curl_init();

        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);

        // Execute
        $data = curl_exec($ch);

        // Closing
        curl_close($ch);

        $weather = json_decode($data, true);
        return ["weather" => $weather, "ip" => $response];
    }

    public function getWeatherThroughMultiCurl($cIp, $cLat, $cLon)
    {
        $keyArray = include(__DIR__ . '/../../config/api_keys.php');
        $stack = new Ipstack();
        $lat = $cLat;
        $lon = $cLon;
        if (($cLat == null || $cLon == null) && $cIp != null) {
            $ipresponse = $stack->getIpInfo($cIp, $keyArray["keys"]["ipstack"]);
            $lat = $ipresponse["latitude"];
            $lon = $ipresponse["longitude"];
        }

        $dateTime = [time() - 432000, time() - 345600, time() - 259200, time() - 172800, time() - 86400];
        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];

        // Add all curl handlers and remember them
        // Initiate the multi curl handler
        $mh = curl_multi_init();
        $chAll = [];
        foreach ($dateTime as $dt) {
            $ch = curl_init("https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=". $lat . "&lon=".  $lon . "&dt=" . $dt . "&appid=" . $keyArray["keys"]["weather"]);
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mh, $ch);
            $chAll[] = $ch;
        }

        // Execute all queries simultaneously,
        // and continue when all are complete
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        // Close the handles
        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);

        // All of our requests are done, we can now access the results
        $response = [];
        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $response[] = json_decode($data, true);
        }

        return ["weather" => $response ?? null, "ip" => $ipresponse ?? null];
    }
}
