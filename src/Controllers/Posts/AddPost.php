<?php 
// Controllers/Posts/AddPost.php

namespace Application\Controllers\Posts;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Post\PostRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Controllers\DataCheck;

class AddPost
{
    public function execute(array $input)
    {
        $author = null;
        $title = null;
        $content = null;

        if (!empty($input['user_id']) && !empty($input['title']) && !empty($input['content'])) {
            if (is_numeric($input['user_id']) && $input['user_id'] > 0) {
                $author = $input['user_id'];
            }   

            $post_title = new DataCheck();
            $title = $post_title->test_input($input['title']);

            $post = new DataCheck();
            $content = $post->test_input($input['content']);
        } else {
            throw new \Exception ('Veuillez remplir tous les champs du formulaire');
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $success = $postRepository->createPost($title, $author, $content);
        if (!$success) {
            throw new \Exception ('Impossible d\'ajouter votre post');
        } else {
            header('location: index.php');
        }
    }
}