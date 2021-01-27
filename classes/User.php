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
    public function add(string $username, string $email, string $password) : bool {
        // Get last ID before query
        $emptyDb = false;

        $lastIDBefore = $this->_db->sendQuery('SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1');

        if (!$lastIDBefore) $emptyDb = true;
        else {
            $lastIDBefore = $lastIDBefore[0]["user_id"];
        }

        // Add user
        $this->_db->sendQuery(
            'INSERT INTO user(username, mail, password)
                VALUES (:username, :mail, :password)',
            ["username" => $username, "mail" => $email, "password" => $password],
            false
        );

        // Get last ID after query
        $lastIDAfter = -1;

        if (!$emptyDb)
            $lastIDAfter = $this->_db->sendQuery('SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1')[0]["user_id"];

        // Return true if the user is created
        if (!$emptyDb && ($lastIDBefore === $lastIDAfter)) {
            return false;
        } else {
            return true;
        }
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

    // CHECK
    public function checkUsername($username, $oldUsername = "") : bool {
        if ($oldUsername) {
            if ($username == $oldUsername)
                return true;
        }

        // Check length
        $usernameLen = strlen($username);

        if ($usernameLen < 1 OR $usernameLen > 32) {
            return false;
        }

        // Check availability
        $usrResult = $this->_db->sendQuery('SELECT user_id FROM user WHERE username = :username', ["username" => $username]);

        if ($usrResult) {
            return false;
        }

        return true;
    }

    public function checkEmail($email, $oldEmail = "") : bool {
        if ($oldEmail) {
            if ($email == $oldEmail)
                return true;
        }

        // Check validity
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Check availability
        $emailResult = $this->_db->sendQuery('SELECT user_id FROM user WHERE email = :email', ["email" => $email]);

        if ($emailResult) {
            return false;
        }

        return true;
    }

    public function checkPassword($password, $passwordPeppered, $pepper) : bool {
        $password = hash_hmac("sha256", $password, $pepper);

        if (!password_verify($password, $passwordPeppered)) {
            return false;
        }

        return true;
    }

    // OTHER
    public function hashPassword($password, $pepper) {
        // Hash password
        $password_peppered = hash_hmac("sha256", $password, $pepper);
        return password_hash($password_peppered, PASSWORD_ARGON2ID);
    }
}
