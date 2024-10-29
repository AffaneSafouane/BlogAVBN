<?php 
// Controller/Post.php

namespace Application\Controllers\Posts;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Post\PostRepository;
use Application\Model\Comment\CommentRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Users\UserRepository;

class Post 
{
    public function execute(string $identifier) 
    {
        if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER'])) {
            $user = new UserRepository();
            $user->connection = new DatabaseConnection();
            $loggedUser = $user->getUser($_COOKIE['LOGGED_USER']);
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getComments($identifier);

        require('template/front/post.php');
    }
}
