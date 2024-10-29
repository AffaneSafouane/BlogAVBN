<?php
// Controllers/Posts/DeletePost.php

namespace Application\Controllers\Posts;

require($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Post\PostRepository;
use Application\Lib\Database\DatabaseConnection;

class DeletePost
{
    public function execute(string $identifier)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deletePost = new PostRepository();
            $deletePost->connection = new DatabaseConnection();
            $deleting = $deletePost->deletePost($identifier);
            if (!$deleting) {
                throw new \Exception('Impossible de supprimer le post !');
            } else {
                header('location: index.php');
            }
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);
        if ($post === null) {
            throw new \Exception("Le post $identifier n'existe pas.");
        }

        require('./template/front/delete_post.php');
    }
}
