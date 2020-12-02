<?php
namespace Anax\View;

use DateTime;

$error = false;
if (isset($body["message"]) && $body["message"] == 'Nothing to geocode') {
    $error = true;
}
if (!isset($body[0]["current"])) {
    $error = true;
}
$x = $lat;
$y = $lon;
echo "<script> window.onload = function() {
    map.setView([$x, $y], 15);
}; </script>";
?>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css">

<div id="map"></div>
<script src='https://unpkg.com/leaflet@1.3.3/dist/leaflet.js'></script>
<h1>Väderrapport</h1>
<form action="historical_weather_check/weather" method="POST" class="weather-form">
    <label for="ip">IP: </label>
    <input type="text" name="ip" id="ip">
    <!-- <input type="submit" value="Check"> -->
<!-- </form> -->
<!-- <form action="weather_check/ipstack" method="POST" class="weather-form"> -->
    <label for="lat">Latitude: </label>
    <input type="text" name="lat" id="lat">
    <label for="lon">Longitude: </label>
    <input type="text" name="lon" id="lon"><br>
    <input type="submit" value="Check">
</form>
<?php if ($error) : ?>
    <p>Ingen info hittades för angivna ip/koordinater</p>
 
<?php else : ?>
    <?php if ($ip != null) : ?>
    <table class="weather-info">
    <th>Världsdel</th>
    <th>Land</th>
    <th>Län</th>
    <th>Stad</th>
    <tr>
    <td><?= $ip["continent_name"] ?></td>
    <td><?= $ip["country_name"] ?></td>
    <td><?= $ip["region_name"] ?></td>
    <td><?= $ip["city"] ?></td>
    </tr>
    </table>
    <?php endif; ?>

    
    <table class="weather-info">
    <th>Datum/Tid</th>    
    <th>Temp</th>    
    <th>Fuktighet</th>
    <th>Väder</th>
    <?php foreach ($body as $key => $value): ?> 
        <?php
            $date = new DateTime();
            $date->setTimestamp($value["current"]["dt"]);
        ?>
        <tr>
            <td><?= $date->format('d-m-Y H:i:s') ?></td>        
            <td><?= round($value["current"]["temp"] - 273) . "&deg C" ?></td>        
            <td><?= $value["current"]["humidity"] . "%" ?></td>
            <td><?= $value["current"]["weather"][0]["main"] ?></td>
        </tr>
    
    <?php endforeach; ?>
</table>
<?php endif; ?>




