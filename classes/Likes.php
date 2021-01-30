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

    public function getCount(int $post_id): string {
        $count = $this->_db->sendQuery('SELECT COUNT(*) AS count FROM likes WHERE post_id = :post_id', ["post_id" => $post_id]);

	if ($count) {
	    $count = $count["0"]["count"];
	} else {
	    $count = "";
	}

	return $count;
    }

    public function exists(int $post_id, int $user_id): bool {
	$exist = $this->_db->sendQuery(
	    'SELECT post_id FROM likes WHERE post_id = :post_id AND user_id = :user_id',
	    ["post_id" => $post_id, "user_id" => $user_id]
	);

	if ($exist) return true;
	else return false;
    }

    // ADD
    public function addOrDelete(int $post_id, int $user_id): bool {
	if ($this->exists($post_id, $user_id)) {
	    $this->del($post_id, $user_id);
	    return false;
	} else {
	    $this->add($post_id, $user_id);
	    return true;
	}
    }

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
    public function del(int $post_id, int $user_id) {
        $this->_db->sendQuery(
            'DELETE FROM likes
                WHERE post_id = :post_id AND user_id = :user_id',
            ["post_id" => $post_id, "user_id" => $user_id],
            false
        );
    }

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
