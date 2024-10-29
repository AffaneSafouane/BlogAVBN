<?php 
// Controllers/Users/UpdatePassword.php
// problème infos formulaire afficher dans url

namespace Application\Controllers\Users;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Users\UserRepository;
use Application\Lib\Database\DatabaseConnection;

class UpdatePassword
{
    public function execute(string $identifier, ?array $input)
    {
        if ($input !== null) {
            $password = null;
            $newPassword = null;
            $confirmPassword = null;

            if (!empty($input['password']) && !empty($input['new_password']) && !empty($input['confirm_password'])) {
                $password = $input['password'];
                $newPassword = $input['new_password'];
                $confirmPassword = $input['confirm_password'];
                
                $userRepository = new UserRepository();
                $userRepository->connection = new DatabaseConnection();
                $user = $userRepository->userInfo($identifier);

                if (password_verify($password, $user->password)) {
                    if ($password !== $newPassword) {
                        if ($newPassword == $confirmPassword) {
                            $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        } else {
                            throw new \Exception("Vos mot de passe ne correspondent pas");
                        }
        
                        $account = new UserRepository();
                        $account->connection = new DatabaseConnection();
                        $success = $account->updatePassword($hashPassword, $identifier);
        
                        if (!$success) {
                            throw new \Exception('Une erreur est survenue lors de la modification de votre mot de passe');
                        } else {
                            header("location: index.php?action=user&id=" . $identifier);
                        }
                    } else {
                        throw new \Exception('Votre nouveau mot de passe ne peut pas être le même que l\'ancien');
                    }
                } else {
                    throw new \Exception('Votre ancien mot de passe est incorrecte');
                }
            } else {
                throw new \Exception('Veuillez remplir tous les champs du formulaire');
            }
        } 

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $user = $userRepository->userInfo($identifier);
        if ($user === null) {
            throw new \Exception("L'utilisateur $identifier n'existe pas");
        } 
        require("./template/front/update_password.php");
    }
}