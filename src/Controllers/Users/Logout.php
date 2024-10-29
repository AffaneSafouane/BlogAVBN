<?php
// Controllers/User/Logout.php

namespace Application\Controllers\Users;

require($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Users\UserRepository;

class Logout
{
    public function execute()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $logout = new UserRepository();
        $loggedoutUser = $logout->logout();

        if ($loggedoutUser) {
            header('index.php');
        } else {
            throw new \Exception('Un problème est survenu lors de la déconnexion');
        }
    }
}
