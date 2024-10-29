<?php 
// Controllers/Comment/AddComment.php

namespace Application\Controllers\Comment;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Comment\CommentRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Controllers\DataCheck;

class AddComment
{
    public function execute(string $post, array $input) 
    {
        $author = null;
        $comment = null;
        
        if (!empty($input['user_id']) && !empty($input['comment'])) {
            if (is_numeric($input['user_id']) && $input['user_id'] > 0) {
                $author = $input['user_id'];
            } else {
                throw new \Exception("L'identifiant d'utilisateur n'est pas valide");
            }
            
            $content = new DataCheck();
            $comment = $content->test_input($input['comment']);
        } else {
            throw new \Exception('Veuillez remplir toutes les données du formulaire');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($post, $author, $comment);
        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('location: index.php?action=post&id=' . $post);
        }
    }
}