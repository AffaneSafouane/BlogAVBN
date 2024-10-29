<?php
// Controllers/Users/Login.php

namespace Application\Controllers\Users;

require($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Users\UserRepository;
use Application\Lib\Database\DatabaseConnection;

class Login
{
    public function execute(?array $input)
    {
        if ($input !== null && !empty($input)) {
            $email = null;
            $password = null;

            if (!empty($input['email']) && !empty($input['password'])) {
                if (filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = $input['email'];
                } else {
                    throw new \Exception("Votre email n'est pas valide");
                }

                $password = $input['password'];

                $userLogin = new UserRepository();
                $userLogin->connection = new DatabaseConnection();
                $user = $userLogin->getUser($email);

                if ($user !== null) {
                    if ($user->email === $email && password_verify($password, $user->password)) {
                        $loginUser = new UserRepository();
                        $loggedUser = $loginUser->loginUser($user);

                        if (!$loggedUser) {
                            throw new \Exception('Une erreur est survenu lors de la connexion');
                        } else {
                            header("location: index.php?action=user&id=" . $user->identifier);
                        }
                    } else {
                        throw new \Exception('Votre utilisateur ou mot de passe est incorrecte');
                    }
                } else {
                    throw new \Exception("Votre utilisateur n'existe pas");
                }   
            } else {
                throw new \Exception('Veuillez remplir tous les champs du formulaire');
            }
        } else {
            require('template/front/login.php');
        }
    }
}
