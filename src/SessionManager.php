<?php
namespace TuDublin;


class SessionManager
{
    private $username = '';
    private $loggedIn = false;

    public function __construct()
    {
        if(isset($_SESSION['username'])){
            $this->username = $_SESSION['username'];
            $this->loggedIn = true;
        }
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
    }

    public function usernameFromSession()
    {
        return $this->username;
    }
}
