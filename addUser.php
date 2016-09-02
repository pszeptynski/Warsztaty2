<?php

require_once('src/init.php');
require_once('src/Users.php');



$user1 = new Users();

$user1->setEmail('roman@poczta.pl');
$user1->setPassword('SuperTajneX');
$user1->setUsername('FrywolnyRomek');

var_dump($user1->getID());

if ($user1->saveToDB($conn)) {
    echo "Dodano użytkownika";
} else {
    echo "Nie udało się dodać użytkownika.<br>";
    echo $conn->error;
}

var_dump($user1->getID());



$conn->close();
$conn = null;
