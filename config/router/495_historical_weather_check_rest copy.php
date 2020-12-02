<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Historical Weather Check",
            "mount" => "historical_weather_check_rest",
            "handler" => "\Anax\Controller\HistoricalWeatherCheckRestController",
        ],
    ]
];
