<?php 

namespace Application\Controllers;

require($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Model\Post\PostRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Users\UserRepository;

class Homepage
{
    public function execute() 
    {
        if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER'])) {
            $user = new UserRepository();
            $user->connection = new DatabaseConnection();
            $loggedUser = $user->getUser($_COOKIE['LOGGED_USER']);
        }
        
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $posts = $postRepository->getPosts();

        require('./template/front/homepage.php');
    }
}
