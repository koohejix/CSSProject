<?php 

require_once('Models/ProfilePopulate.php');

$id = $_GET['id'];

$userData = new ProfilePopulate();
$profile = $userData->fetchUser($id)[0];

header('Content-Type: application/json; charset=utf-8');
echo( json_encode([
    'lat' => $profile->getLatitude(), 
    'lng' => $profile->getLongitude()
]));
