<?php

class User {
    // Attributes
    private $_db;

    // Constructor
    public function __construct(PDOFactory $db) {
        $this->_db = $db;
    }

    // GET
    public function getById(int $user_id): array {
        return $this->_db->sendQuery(
            'SELECT
                    user_id,
                    username,
                    password
                FROM user
                WHERE user_id = :user_id
                LIMIT 1',
            ["user_id" => $user_id]
        );
    }

    public function getAll(): array {
        return $this->_db->sendQuery(
            'SELECT
                    user_id,
                    username,
                    password
                FROM user'
        );
    }

    // ADD
    public function add(string $username, string $password) {
        $this->_db->sendQuery(
            'INSERT INTO user(username, password)
                VALUES (:username, :password)',
            ["username" => $username, "password" => $password],
            false
        );
    }

    // UPDATE

    // DELETE
    public function deleteById(int $user_id) {
        $this->_db->sendQuery(
            'DELETE FROM user WHERE user_id = :user_id',
            ["user_id" => $user_id],
            false
        );
    }
}