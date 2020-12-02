<?php
namespace Anax\View;
// var_dump($ip);
$error = false;
if ($body == null) {
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
<form action="weather_check/weather" method="POST" class="weather-form">
    <label for="ip">IP: </label>
    <input type="text" name="ip" id="ip">
    <label for="lat">Latitude: </label>
    <input type="text" name="lat" id="lat">
    <label for="lon">Longitude: </label>
    <input type="text" name="lon" id="lon"><br>
    <input type="submit" value="Check">
</form>
<?php if ($error) : ?>
    <p>Ingen info hittades för angivna ip/koordinater</p>
 
<?php else : ?>
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
    
    <table class="weather-info">
    <th>Datum/Tid</th>    
    <th>Temp</th>    
    <th>Fuktighet</th>
    <th>Väder</th>
    <?php foreach ($body as $key =>$value): ?>     
    <tr>
        <td><?= $value["dt_txt"] ?></td>        
        <td><?= round($value["main"]["temp"] - 273) . "&deg C" ?></td>        
        <td><?= $value["main"]["humidity"] . "%" ?></td>
        <td><?= $value["weather"][0]["main"] ?></td>
    </tr>
    
    <?php endforeach; ?>
</table>
<?php endif; ?>




