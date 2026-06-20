<?php

abstract class Users {
    public $firstName;
    public $lastName;
    public $email;
    protected $password;
    public $createdAt;
    public $updatedAt;
    

    public function __construct($firstName, $lastName, $email, $password, $createdAt, $updatedAt) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function login($email, $password) { 
            $query = "SELECT * FROM users WHERE Email = '$email' AND password = '$password'";
            require_once 'config.php';
            $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $result = mysqli_query($cn, $query);
            if ($arr = mysqli_fetch_assoc($result)) {
                switch ($arr['role']) {
                    case 'user':
                        $user = new user($arr['id'], $arr['Fname'], $arr['Lname'], $arr['email'], $arr['password'], $arr['created_at'], $arr['updated_at']);
                        break;
                    case 'admin':
                        $user = new Admin($arr['id'], $arr['Fname'], $arr['Lname'], $arr['email'], $arr['password'], $arr['created_at'], $arr['updated_at']);
                        break;
                }
            }
            mysqli_close($cn);
            return $user;
    }
}

class user extends Users {
    public $role = 'user';

    public static function register($firstName, $lastName, $email, $password) { 
        try{
            $query = "INSERT INTO users (First_Name, Last_Name, Email, password)  
                    VALUES ('$firstName', '$lastName', '$email', '$password')";
            require_once 'config.php';
            $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $result = mysqli_query($cn, $query);
            mysqli_close($cn);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    
}

class Admin extends Users {
    public $role = 'admin';

}

