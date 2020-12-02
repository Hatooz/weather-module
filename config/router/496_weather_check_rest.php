<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Check API",
            "mount" => "weather_check_rest",
            "handler" => "\Anax\Controller\WeatherCheckRestController",
        ],
    ]
];
