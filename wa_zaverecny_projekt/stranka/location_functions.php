<?php
include 'config.php';

try {
    $connect = new PDO("mysql:host={$server}; dbname={$db}; charset=UTF8", $user, $pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExpception $e){
    echo $e->getMessage();
}


if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}


$query = $connect->prepare("SELECT ip FROM location WHERE ip = :ip");
$query->bindParam(":ip", $ip);
$query->execute();

if($query->rowCount() == 0){
    $details = json_decode(file_get_contents('http://ip-api.com/json/'.$ip));

    $query = $connect->prepare("INSERT INTO location (ip, country, city, latitude, longitude) VALUES (:ip, :country, :city, :latitude, :longitude)");
    $query->bindParam(":ip", $ip);
    $query->bindParam(":country", $details->country);
    $query->bindParam(":city", $details->city);
    $query->bindParam(":latitude", $details->lat);
    $query->bindParam(":longitude", $details->lon);
    $query->execute();
}

?>