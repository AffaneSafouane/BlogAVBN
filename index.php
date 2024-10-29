<?php
// router index.php
session_start();

require(__DIR__ . "/vendor/autoload.php");

use Application\Controllers\Comment\AddComment;
use Application\Controllers\Comment\UpdateComment;
use Application\Controllers\Homepage;
use Application\Controllers\Posts\Post;
use Application\Controllers\Users\UserInfo;
use Application\Controllers\Contact\AddMessage;
use Application\Controllers\Users\AddUser;
use Application\Controllers\Users\Login;
use Application\Controllers\Users\Logout;
use Application\Controllers\Posts\AddPost;
use Application\Controllers\Posts\UpdatePost;
use Application\Controllers\Comment\DeleteComment;
use Application\Controllers\Posts\DeletePost;
use Application\Controllers\Users\UpdateUser;
use Application\Controllers\Users\DeleteUser;
use Application\Controllers\Users\UpdatePassword;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addPost') {
            if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER'])) {
                (new AddPost())->execute($_POST);
            } else {
                throw new \Exception('Veuillez vous connecter afin de pouvoir ajouter une nouvelle publication');
            }
        } elseif ($_GET['action'] === 'updatePost') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $input = $_POST;
                }

                (new UpdatePost())->execute($identifier, $input);
            } else {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new DeletePost())->execute($identifier);
            } else {
                throw new \Exception('Aucun identifiant de billet envoyé !');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new AddComment())->execute($identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé !');
            }
        } elseif ($_GET['action'] === 'updateComment') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new UpdateComment())->execute($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé !');
            }
        } elseif ($_GET['action'] === 'deleteComment') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new DeleteComment())->execute($identifier, $input);
            } else {
                throw new \Exception('Aucun identifiant de commentaire n\'a été envoyé');
            }
        } elseif ($_GET['action'] === 'addMessage') {
            $input = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }

            (new AddMessage())->execute($input, $_FILES);
        } elseif ($_GET['action'] === 'user') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new UserInfo())->execute($identifier);
            } else {
                throw new \Exception('Aucun identifiant d\'utilisateur n\'a été envoyé');
            }
        } elseif ($_GET['action'] === 'addUser') {
            if (!isset($_SESSION['LOGGED_USER'])) {
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new AddUser())->execute($input);
            } else {
                throw new \Exception('Vous êtes déjà connecter à un compte');
            }
        } elseif ($_GET['action'] === 'updateUser') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new UpdateUser())->execute($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant d\'utilsiateur envoyé !');
            }
        } elseif ($_GET['action'] === 'updatePassword') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new UpdatePassword())->execute($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant d\'utilsiateur envoyé !');
            }
        } elseif ($_GET['action'] === 'deleteUser') {
            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new DeleteUser())->execute($identifier);
            } else {
                throw new \Exception('Aucun identifiant d\'utilisateur envoyé !');
            }
        } elseif ($_GET['action'] === 'login') {
            if (!isset($_SESSION['LOGGED_USER'])) {
                $input = null;
                if ($_SERVER['REQUEST_METHOD']) {
                    $input = $_POST;
                }

                (new Login())->execute($input);
            }
        } elseif ($_GET['action'] === "logout") {
            if (isset($_SESSION['LOGGED_USER'])) {
                (new Logout())->execute();
            } else {
                throw new \Exception('Vous devez être connecté à un compte pour vous déconnecter');
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas !");
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('template/error.php');
}
