<?php
// Controllers/Comment/DeleteComment.php

namespace Application\Controllers\Comment;

require($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Comment\CommentRepository;
use Application\Lib\Database\DatabaseConnection;

class DeleteComment
{
    public function execute(string $identifier, ?array $input)
    {
        if ($input !== null) {
            $post = null;
            
            if (!empty($input['id']) && is_numeric($input['id']) && $input['id'] > 0) {
                $post = $input['id'];
            } else {
                throw new \Exception("L'identifiant envoyé n'est pas valide");
            }

            $deleteComment = new CommentRepository();
            $deleteComment->connection = new DatabaseConnection();
            $deleting = $deleteComment->deleteComment($identifier);
            if (!$deleting) {
                throw new \Exception('Impossible de supprimer le commentaire !');
            } else {
                header('location: index.php?action=post&id=' . $post);
            }
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($identifier);
        if ($comment === null) {
            throw new \Exception("Le commentaire $identifier n'existe pas.");
        }

        require('./template/front/delete_comment.php');
    }
}
