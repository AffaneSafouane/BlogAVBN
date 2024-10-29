<?php
// controller/Contact/AddMessage.php

namespace Application\Controllers\Contact;

require($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Contact\SendContact;
use Application\Lib\Database\DatabaseConnection;
use Application\Controllers\DataCheck;

class AddMessage
{
    public function execute(?array $input, ?array $file)
    {
        if ($input !== null) {
            $author = null;
            $message = null;
            $image = null;

            if (!empty($input['author']) && !empty($input['message'])) {
                if (filter_var($input['author'], FILTER_VALIDATE_EMAIL)){
                    $author = $input['author'];   
                }
                $contact = new DataCheck();
                $message = $contact->test_input($input['message']);
                if (isset($file['screenshot']) && $file['screenshot']['error'] === 0) {
                    $path = ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/upload/");
                    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                    $fileInfo = pathinfo($file['screenshot']['name']);
                    $extension = $fileInfo['extension'];
                    $image = $file['screenshot'];

                    if ($file['screenshot']['size'] > 1000000) {
                        throw new \Exception("L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse");
                    }

                    if (!in_array($extension, $allowedExtensions)) {
                        throw new \Exception("L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée.");
                    }

                    if (!is_dir($path)) {
                        mkdir($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/contact/uploads/", 0777);
                    }

                    $imageName = uniqid() . '- ' . basename($image['name']);
                    $sendContact = new SendContact();
                    $sendContact->connection = new DatabaseConnection();
                    $upload = $sendContact->saveimage($image['tmp_name'], $path . $imageName);
                    if (!$upload) {
                        throw new \Exception('Impossible d\'ajouter votre image');
                    } else {
                        $success = $sendContact->createMessage($author, $message, $imageName);
                        if ($success) {
                            require('template/front/contact_info.php');
                        } else {
                            throw new \Exception("Une erreur est survenu lors du transfert vers la base de donnée");
                        }
                    }
                } else {
                    $sendContact = new SendContact();
                    $sendContact->connection = new DatabaseConnection();
                    $success = $sendContact->createMessage($author, $message, $image);
                    if (!$success) {
                        throw new \Exception('Impossible d\'ajouter votre image');
                    } else {
                        require('template/front/contact_info.php');
                    }
                }
            } else {
                throw new \Exception('Les données du formulaire sont invalides');
            }
        }
        
        require('template/front/contact.php');
    }
}
