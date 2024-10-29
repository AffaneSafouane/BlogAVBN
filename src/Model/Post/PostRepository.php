<?php
// model post.php

namespace Application\Model\Post;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Lib\Database\DatabaseConnection;

class Post
{
    public string $title;
    public string $frenchCreationDate;
    public string $content;
    public string $pseudo;
    public string $identifier;
}

class PostRepository 
{
    public DatabaseConnection $connection;

    public function getPost(string $identifier) : Post {
        // We retrieve a specific blog post
        $statement = $this->connection->getConnection()->prepare(
            "SELECT p.id, p.user_id, p.title, p.content, u.pseudo, DATE_FORMAT(p.post_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
            FROM posts p
            LEFT JOIN users u ON u.user_id = p.user_id 
            WHERE p.id = ?"
        );
        $statement->execute([$identifier]);
    
        $row = $statement->fetch();
        $post = new Post(); 
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->pseudo = $row['pseudo'];
        $post->identifier = $row['id'];
    
        return $post;  
    }

    public function getPosts() : array {    
        // We retrieve the 5 last blog posts
        $statement = $this->connection->getConnection()->query(
            "SELECT p.id, p.user_id, p.title, p.content, u.pseudo, DATE_FORMAT(p.post_date, '%d/%m/%Y à %Hh%imin%ss') 
            AS french_creation_date 
            FROM posts p
            LEFT JOIN users u ON u.user_id = p.user_id 
            ORDER BY post_date 
            DESC LIMIT 0,5"
        );
        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post(); 
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->pseudo = $row['pseudo'];
            $post->identifier = $row['id'];
    
            $posts[] = $post;
        }
    
        return $posts;   
    }  

    public function createPost(string $title , string $author, string $content) : bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO posts(title, user_id, content, post_date) VALUES (?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$title, $author, $content]);

        return ($affectedLines > 0);
    }

    public function updatePost(string $identifier, string $title, string $content) : bool 
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE posts SET title = ?, content = ? WHERE id = ?'
        );
        $affectedLine = $statement->execute([$title, $content, $identifier]);

        return ($affectedLine > 0);
    }

    public function deletePost(string $identifier) : bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM posts WHERE id = ?'
        );
        $affectedLine = $statement->execute([$identifier]);

        return $affectedLine;
    }
}  
