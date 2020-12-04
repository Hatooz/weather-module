<?php

namespace Anax\Ipstack;

/**
 * A model class retrievieng data from an ipstack server.
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Ipstack
{
    public function getIpInfo(string $ip, $key) : array
    {
         
        $url = "http://api.ipstack.com/$ip?access_key=" . $key;
        $res = file_get_contents($url);
        $info = json_decode($res, true);
        return $info;
    }
}
