<?php

require_once('src/init.php');
require_once('src/Users.php');

$user1 = Users::loadUserById($conn, 1);

var_dump($user1);

$user1->setUsername("Janusz");
$user1->setEmail("Janusz@poczta.pl");

$user1->saveToDB($conn);


var_dump($user1);

$conn->close();
$conn = null;
