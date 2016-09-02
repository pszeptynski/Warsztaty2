<?php

class Users {

    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email - "";
        $this->hashedPassword = "";
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getID() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function getEmail() {
        return $this->email;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            //saving new user to DB
            $sql = "INSERT INTO Users(username, email, hashed_password)
                    VALUES ('$this->username', '$this->email', '$this->hashedPassword')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = " UPDATE Users SET username='$this->username',
                                    email='$this->email',
                                    hashed_password='$this->hashedPassword'
                   WHERE id=$this->id";

            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    static public function loadUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id=$id";

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new Users();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM Users";
// Tworzymy pustą tablicę którą potem wypełnimy obiektami wczytanymi z bazy danych
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedUser = new Users();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1; // Jako, że usnęliśmy obiekt to zmieniamy jego id na -1
                return true;
            }
            return false;
        }
        return true; // jeśli obiektu nie było w bazie, to można od razu zwrócić true
    }

}
