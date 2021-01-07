<?php

class Likes {
    // Attributes
    private $_db;

    // Constructor
    public function __construct(PDOFactory $db) {
        $this->_db = $db;
    }

    // GET
    public function getByPostId(int $post_id): array {
        return $this->_db->sendQuery(
            'SELECT
                    user.username
                FROM likes
                JOIN user on user.user_id = likes.user_id
                WHERE likes.post_id = :post_id',
            ["post_id" => $post_id]
        );
    }

    public function getByUserId(int $user_id): array {
        return $this->_db->sendQuery(
            'SELECT
                    post.title
                FROM likes
                JOIN post on post.post_id = likes.post_id
                WHERE likes.user_id = :user_id',
            ["user_id" => $user_id]
        );
    }

    // ADD
    public function add(int $post_id, int $user_id) {
        $this->_db->sendQuery(
            'INSERT INTO likes(post_id, user_id)
                VALUES (:post_id, :user_id)',
            ["post_id" => $post_id, "user_id" => $user_id],
            false
        );
    }

    // UPDATE

    // DELETE
    public function deleteByPostId(int $post_id) {
        $this->_db->sendQuery(
            'DELETE FROM likes WHERE post_id = :post_id',
            ["post_id" => $post_id],
            false
        );
    }

    public function deleteByUserId(int $user_id) {
        $this->_db->sendQuery(
            'DELETE FROM likes WHERE user_id = :user_id',
            ["user_id" => $user_id],
            false
        );
    }
}