<?php 
// Controllers/Users/UpdateUser.php

namespace Application\Controllers\Users;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Users\UserRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Controllers\DataCheck;

class UpdateUser
{
    public function execute(string $identifier, ?array $input)
    {
        if ($input !== null) {
            $email = null;
            $pseudo = null;
            $age = null;
            $sexe = null;
            $last_name = null;
            $first_name = null;

            if (!empty($input['email']) && !empty($input['pseudo']) && !empty($input['age']) && !empty($input['sexe'])) {
                if (filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = $input['email'];
                } else {
                    throw new \Exception("Votre email n'est pas valide");
                }

                if (is_numeric($input['age']) && $input['age'] > 17) {
                    $age = (int)$input['age'];
                } else {
                    throw new \Exception("Votre age n'est pas valide");
                }

                $userName = new DataCheck();
                $pseudo = $userName->test_input($input['pseudo']);

                if ($input['sexe'] === 'F' || $input['sexe'] === 'H') {
                    $sexe = $input['sexe'];
                } else {
                    throw new \Exception('Les données concernant le genre sont incorrectes');
                }

                if (!empty($input['last_name'])) {
                    $family_name = new DataCheck();
                    $last_name = $family_name->test_input($input['last_name']);
                }

                if (!empty($input['first_name'])) {
                    $name = new DataCheck();
                    $first_name = $name->test_input($input['first_name']);
                }
                
                $account = new UserRepository();
                $account->connection = new DatabaseConnection();
                $success = $account->updateUser($email, $pseudo, $age, $sexe, $last_name, $first_name, $identifier);

                if (!$success) {
                    throw new \Exception('Une erreur est survenue lors de la création de votre compte');
                } else {
                    header("location: index.php?action=user&id=" . $identifier);
                }
            } else {
                throw new \Exception('Veuillez remplir toutes les données du formulaire');
            }
        } 

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $user = $userRepository->userInfo($identifier);
        if ($user === null) {
            throw new \Exception("L'utilisateur $identifier n'existe pas");
        } 
        require("./template/front/update_user.php");
    }
}