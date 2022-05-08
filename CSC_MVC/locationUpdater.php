<?php

require_once('Models/UpdateLocation.php');

session_start();

$id = $_SESSION['userid'];
$lat = $_GET['lat'];
$long = $_GET['long'];

$updater = new UpdateLocation();
$updater->updateLocation($id, $lat, $long);
echo $id;
echo $lat;
echo $long;
