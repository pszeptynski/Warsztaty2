<?php

require_once ('src/init.php');
require_once ('src/Users.php');

$user1 = Users::loadUserById($conn, 1);

var_dump($user1);

$conn->close();
$conn = null;
