<?php
// Model/Contact/SendContact.php

namespace Application\Model\Contact;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Lib\Database\DatabaseConnection;

class Contact
{
    public string $author;
    public string $message;
    public string $screenshot;
}

class SendContact
{
    public DatabaseConnection $connection;

    public function createMessage(string $author, string $message, ?string $screenshot) : bool 
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO contact(author, message, screenshot, contact_date) VALUES(?, ?, ?, NOW())"
        );
        $messageSent = $statement->execute([$author, $message, $screenshot]);
    
        return ($messageSent > 0);
    }

    public function saveImage(string $name, string $path): bool
    {
        $isFileLoaded = move_uploaded_file($name, $path);

        return ($isFileLoaded > 0);
    }
}
