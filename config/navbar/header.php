<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",
 
    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "IP Check",
            "url" => "ip_check",
            "title" => "IP Check",
        ],
        // [
        //     "text" => "IP Check REST",
        //     "url" => "ip_check_rest",
        //     "title" => "IP Check REST",
        // ],
        // [
        //     "text" => "Ipsack Check REST",
        //     "url" => "ipstack_api",
        //     "title" => "Ipstack Check REST",
        // ],
        [
            "text" => "Väderrapport",
            "url" => "weather_check",
            "title" => "Weather Check",
        ],
        [
            "text" => "Föregående väderrapport",
            "url" => "historical_weather_check",
            "title" => "Weather Check",
        ],
        [
            "text" => "REST services",
            "url" => "restServices",
            "title" => "Weather Check",
        ],
        // [
        //     "text" => "Föregående väderrapport REST",
        //     "url" => "historical_weather_check_rest",
        //     "title" => "Weather Check",
        // ],
        // [
        //     "text" => "Verktyg",
        //     "url" => "verktyg",
        //     "title" => "Verktyg och möjligheter för utveckling.",
        // ],
    ],
];
