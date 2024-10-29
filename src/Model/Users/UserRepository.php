<?php
// Model/User/UserRepository.php

namespace Application\Model\Users;

require($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Lib\Database\DatabaseConnection;

class Users
{
    public string $email;
    public string $password;
    public string $pseudo;
    public int $age;
    public string $sexe;
    public ?string $lastName;
    public ?string $firstName;
    public string $userCreationDate;
    public string $identifier;
}

class UserRepository
{
    public DatabaseConnection $connection;

    public function newUser(string $email, string $password, string $pseudo, int $age, string $sexe, ?string $last_name, ?string $first_name): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO users(email, password, pseudo, age, sexe, last_name, first_name, creation_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())"
        );
        $affectedLine = $statement->execute([$email, $password, $pseudo, $age, $sexe, $last_name, $first_name]);

        return ($affectedLine > 0);
    }

    public function getUser(string $email): Users
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT user_id, email, pseudo, password FROM users WHERE email = ?"
        );
        $statement->execute([$email]);

        $row = $statement->fetch();
        $user = new Users();
        $user->identifier = $row['user_id'];
        $user->email = $row['email'];
        $user->pseudo = $row['pseudo'];
        $user->password = $row['password'];

        return $user;
    }

    public function loginUser(Users $user): array
    {
        $loggedUser = [
            'email' => $user->email,
            'pseudo' => $user->pseudo,
            'user_id' => $user->identifier,
        ];

        setcookie(
            'LOGGED_USER',
            $loggedUser['email'],
            [
                'expires' => time() + 365*24*3600,
                'secure' => true,
                'httponly' => true,
            ]
        );

        $_SESSION['LOGGED_USER'] = $loggedUser['user_id'];

        return $loggedUser;
    }

    public function logout() 
    {
        $_SESSION = array();
        session_unset();
        session_destroy();
        header('location: index.php');
        exit();
    }

    public function userInfo(string $identifier): Users
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT user_id, email, pseudo, password, age, sexe, last_name, first_name, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS user_creation_date 
            FROM users 
            WHERE user_id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $user = new Users();
        $user->identifier = $row['user_id'];
        $user->email = $row['email'];
        $user->pseudo = $row['pseudo'];
        $user->password = $row['password'];
        $user->age = $row['age'];
        $user->sexe = $row['sexe'];
        $user->lastName = $row['last_name'];
        $user->firstName = $row['first_name'];
        $user->userCreationDate = $row['user_creation_date'];
        
        return $user;
    }

    public function updateUser(string $email, string $pseudo, int $age, string $sexe, ?string $last_name, ?string $first_name, string $identifier) : bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE users SET email = ?, pseudo = ?, age = ?, sexe = ?, last_name = ?, first_name = ? WHERE user_id = ?'
        );
        $affectedLine = $statement->execute([$email, $pseudo, $age, $sexe, $last_name, $first_name, $identifier]);

        return ($affectedLine > 0);
    }

    public function deleteUser(string $identifier) : bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM users WHERE user_id = ?'
        );
        $affectedLine = $statement->execute([$identifier]);

        return $affectedLine;
    }

    public function updatePassword(string $password, string $identifier) : bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE users SET password = ? WHERE user_id = ?'
        );
        $affectedLine = $statement->execute([$password, $identifier]);

        return $affectedLine;
    } 
}
