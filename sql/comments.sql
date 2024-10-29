USE blog;

CREATE TABLE `comments` (
    `id` int (11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `post_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `comment` text NOT NULL,
    `review` int NOT NULL DEFAULT 3,
    `comment_date` datetime NOT NULL, 
    FOREIGN KEY (post_id) REFERENCES posts (id),
    FOREIGN KEY (user_id) REFERENCES users (user_id)
);

INSERT INTO `comments` (`post_id`, `user_id`, `comment`, `comment_date`) VALUES
(4, 1, 'Preum\'s', '2022-03-03 13:00:42'),
(4, 2, 'Quelqu\'un a un avis là-dessus ? Je ne sais pas quoi en penser.', '2022-03-03 13:01:42');    