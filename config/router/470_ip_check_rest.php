<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ipstack API",
            "mount" => "ipstack_api",
            "handler" => "\Anax\Controller\IpstackApiController",
        ],
    ]
];
