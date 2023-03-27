<?php
require 'header.php';
$city = null;
if (isset($_POST['name'])) {
    $city = $_POST['name'];
}
require 'key.php';

if ($city != null) {
    $curl1 = curl_init("http://api.openweathermap.org/geo/1.0/direct?q={$city}&limit=1&appid={$APIkey}");
    curl_setopt_array($curl1, [
        CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
        CURLOPT_RETURNTRANSFER => true
    ]);

    $data1 = curl_exec($curl1);
    if ($data1 === false) {
        var_dump(curl_error($curl1));
    } else {
        $data1 = json_decode($data1, true);
        $lat = $data1[0]["lat"];
        $lon = $data1[0]["lon"];
    }
    curl_close($curl1);

    $curl2 = curl_init("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$APIkey}&units=metric");
    curl_setopt_array($curl2, [
        CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
        CURLOPT_RETURNTRANSFER => true
    ]);
    $data2 = curl_exec($curl2);
    if ($data2 === false) {
        var_dump(curl_error($curl2));
    } else {
        $data2 = json_decode($data2, true);
        echo 'il fait actuellement ' . round(($data2['main']['temp'])) . ' °C.';
    }
    curl_close($curl2);
}

?>

<form action="" method="post">
    <input type="text" name="name" placeholder="entrez une ville">
    <button type="submit">Rechercher</button>
</form>