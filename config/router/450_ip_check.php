<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP check",
            "mount" => "ip_check",
            "handler" => "\Anax\Controller\IpCheckController",
        ],
    ]
];
