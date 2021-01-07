<?php

class Post {
    // Attributes
    private $_db;

    // Constructor
    public function __construct(PDOFactory $db) {
        $this->_db = $db;
    }

    // GET
    public function getById(int $post_id): array {
        return $this->_db->sendQuery(
            'SELECT
                    post.post_id,
                    user.username,
                    post.title,
                    post.creation_timestamp,
                    post.img_path,
                    COUNT(likes.post_id) as likes
                FROM post
                JOIN user ON user.user_id = post.user_id
                JOIN likes ON likes.post_id = post.post_id
                WHERE post.post_id = :post_id
                LIMIT 1',
                ["post_id" => $post_id]
        );
    }

    public function getAll(): array {
        return $this->_db->sendQuery(
            'SELECT
                    post.post_id,
                    user.username,
                    post.title,
                    post.creation_timestamp,
                    post.img_path,
                    COUNT(likes.post_id) as likes
                FROM post
                JOIN user ON user.user_id = post.user_id
                LEFT JOIN likes ON likes.post_id = post.post_id
                ORDER BY post.creation_timestamp DESC'
        );
    }

    // ADD
    public function add(int $user_id, string $title, string $img_path) {
        $this->_db->sendQuery(
            'INSERT INTO post(user_id, title, img_path)
                VALUES (:user_id, :title, :img_path)',
            ["user_id" => $user_id, "title" => $title, "img_path" => $img_path],
            false
        );
    }

    // UPDATE

    // DELETE
    public function deleteById(int $post_id) {
        $this->_db->sendQuery(
            'DELETE FROM post WHERE post_id = :post_id',
            ["post_id" => $post_id],
            false
        );
    }
}