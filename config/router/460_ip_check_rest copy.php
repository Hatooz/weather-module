<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP check Rest",
            "mount" => "ip_check_rest",
            "handler" => "\Anax\Controller\IpCheckRestController",
        ],
    ]
];
