<?php

require_once('src/init.php');
require_once('src/Users.php');

// wywołaj statyczną metodę loadUserById podając jej id istniejące w bazie
$user1 = Users::loadUserById($conn, 1);

var_dump($user1);
// zwraca null jeśli nie ma takiego id w bazie


$conn->close();
$conn = null;
