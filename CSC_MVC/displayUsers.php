<?php

require_once ('Models/AllUsers.php');

$page = $_GET['currentpage'];
$offset = ($page - 1) * 25;

$userData = new AllUsers();

$users = $userData->fetchUsers($offset);

header('Content-Type: application/json; charset=utf-8');
echo(json_encode($users));