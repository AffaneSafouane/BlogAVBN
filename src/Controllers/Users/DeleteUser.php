<?php
// Controllers/Users/DeleteUser.php

namespace Application\Controllers\Users;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Users\UserRepository;
use Application\Lib\Database\DatabaseConnection;

class DeleteUser
{
    public function execute(string $identifier)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_destroy();
            
            $deleteUser = new UserRepository();
            $deleteUser->connection = new DatabaseConnection();
            $deleting = $deleteUser->deleteUser($identifier);
            if (!$deleting) {
                throw new \Exception('Impossible de supprimer l\'utilisateur !');
            } else {
                header('location: index.php');
            }
        }

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $user = $userRepository->userInfo($identifier);
        if ($user === null) {
            throw new \Exception("L'utilisateur $identifier n'existe pas.");
        }

        require('./template/front/delete_user.php');
    }
}