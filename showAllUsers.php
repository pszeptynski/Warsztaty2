<?php

require_once('src/init.php');
require_once('src/Users.php');

// wywołaj statyczną metodę loadAllUsers
$users = Users::loadAllUsers($conn);

var_dump($users);

$conn->close();
$conn = null;
