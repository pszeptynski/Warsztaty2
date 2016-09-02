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

            $sql = "INSERT INTO users(username, email, hashed_password)
                    VALUES ('$this->username', '$this->email', '$this->hashedPassword')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }

}
