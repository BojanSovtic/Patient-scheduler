<?php

class Korisnik {
    public $username;
    public $password;
    public $email;
    
    function __construct($username, $password, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }


}
