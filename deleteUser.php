<?php

require_once('src/init.php');
require_once('src/Users.php');

$id = 10;

// wywołaj statyczną metodę loadUserById podając jej id istniejące w bazie
$user1 = Users::loadUserById($conn, $id);
var_dump($user1);

if ($user1) {
    if ($user1->delete($conn)) {
        echo "Usunięto użytkownika.";
    } else {
        echo "Nie udało się usunąć użytkownika.";
    }
} else {
    echo "Nie znaleziono użytkownikao id: $id";
}   

$conn->close();
$conn = null;
