<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Historical Weather Check",
            "mount" => "historical_weather_check",
            "handler" => "\Anax\Controller\HistoricalWeatherCheckController",
        ],
    ]
];
