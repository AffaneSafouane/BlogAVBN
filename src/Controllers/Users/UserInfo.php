<?php 
// Controllers/User.php

namespace Application\Controllers\Users;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Users\UserRepository;

class UserInfo 
{
    public function execute(string $identifier)
    {
        if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER'])) {
            $userInfo = new UserRepository();
            $userInfo->connection = new DatabaseConnection();
            $user = $userInfo->userInfo($identifier);
        }

        require('./template/front/user_info.php');
    }
}