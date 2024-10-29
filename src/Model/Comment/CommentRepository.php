<?php
// model/comments.php

namespace Application\Model\Comment;

require ($_SERVER['DOCUMENT_ROOT'] . "/BlogMVC/vendor/autoload.php");

use Application\Lib\Database\DatabaseConnection;

class Comments
{
    public string $identifier;
    public string $pseudo;
    public string $frenchCreationDate;
    public string $comment;
    public string $post;
}

class CommentRepository
{
    public DatabaseConnection $connection;

    public function getComments(string $post): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT c.id, u.pseudo, c.comment, c.post_id, c.user_id, DATE_FORMAT(c.comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
            FROM comments c 
            LEFT JOIN users u ON u.user_id = c.user_id
            WHERE post_id = ? 
            ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {
            $comment = new Comments();
            $comment->identifier = $row['id'];
            $comment->pseudo = $row['pseudo'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->post = $row['post_id'];

            $comments[] = $comment;
        }

        return $comments;
    }

    public function getComment(string $identifier) : Comments {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT c.id, u.pseudo, c.comment, c.post_id, c.user_id, DATE_FORMAT(c.comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
            FROM comments c 
            LEFT JOIN users u ON u.user_id = c.user_id
            WHERE id = ? "
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $comment = new Comments();
        $comment->identifier = $row['id'];
        $comment->pseudo = $row['pseudo'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['comment'];
        $comment->post = $row['post_id'];

        return $comment;
    }

    public function createComment(string $post, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    }

    public function updateComment(string $identifier, string $comment) : bool 
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET comment = ? WHERE id = ?'
        );
        $affectedLine = $statement->execute([$comment, $identifier]);

        return $affectedLine;
    }

    public function deleteComment(string $identifier) : bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM comments WHERE id = ?'
        );
        $affectedLine = $statement->execute([$identifier]);

        return $affectedLine;
    }
}
