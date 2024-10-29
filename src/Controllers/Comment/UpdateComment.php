<?php 
// Controllers/Comment/UpdateComment.php

namespace Application\Controllers\Comment;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Comment\CommentRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Controllers\DataCheck;

class UpdateComment
{
    public function execute(string $identifier, ?array $input)
    {
        // It handles the form submission when there is an input.
        if ($input !== null) {
            $comment = null;
            $post = null;

            if (!empty($input['comment']) && !empty($input['id'])) {
                if (is_numeric($input['id']) && $input['id'] > 0) {
                    $post = $input['id'];
                }

                $content = new DataCheck();
                $comment = $content->test_input($input['comment']);
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $updateComment = new CommentRepository();
            $updateComment->connection = new DatabaseConnection();
            $success = $updateComment->updateComment($identifier, $comment);
            if (!$success) {
                throw new \Exception('Impossible de modifier le commentaire !');
            } else {
                header('location: index.php?action=post&id=' . $post);
            }
        }

        // Otherwise, it displays the form.
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($identifier);
        if ($comment === null) {
            throw new \Exception("Le commentaire $identifier n'existe pas.");
        }

        require('template/front/update_comment.php');
    }
}