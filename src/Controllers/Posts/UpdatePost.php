<?php
// Controllers/Posts/UpdatePost.php

namespace Application\Controllers\Posts;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Post\PostRepository;
use Application\Lib\Database\DatabaseConnection;

class UpdatePost 
{
    public function execute(string $identifier, ?array $input)
    {
        if ($input !== null) {
            $title = null;
            $content = null;

            if (!empty($input['title']) && !empty($input['content'])) {
                $title = $input['title'];
                $content = $input['content'];
            } else {
                throw new \Exception ('Veuillez remplir tous les champs du formulaire');
            }

            $updatePost = new PostRepository();
            $updatePost->connection = new DatabaseConnection();
            $success = $updatePost->updatePost($identifier, $title, $content);
            if (!$success) {
                throw new \Exception ('Impossible de modifier le post');
            } else {
                header('location: index.php?action=post&id=' . $identifier);
            }
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);
        if ($post === null) {
            throw new \Exception ("Le post $identifier n'existe pas");
        }
        require('template/front/update_post.php');
    }
}