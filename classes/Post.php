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
                    post.station_id,
                    post.title,
                    post.creation_timestamp,
                    post.img_path,
                    COUNT(likes.post_id) as likes
                FROM post
                JOIN user ON user.user_id = post.user_id
                LEFT JOIN likes ON likes.post_id = post.post_id
                WHERE post.post_id = :post_id
                GROUP BY post.post_id
                LIMIT 1',
                ["post_id" => $post_id]
        );
    }

    public function getAll(int $user_id = null, int $station_id = null): array {
        $sql = 'SELECT
                    post.post_id,
                    user.username,
                    post.station_id,
                    post.title,
                    post.creation_timestamp,
                    post.img_path,
                    COUNT(likes.post_id) as likes
                FROM post
                JOIN user ON user.user_id = post.user_id
                LEFT JOIN likes ON likes.post_id = post.post_id';

        $params = [];

        if (!is_null($user_id) || !is_null($station_id)) {
            $sql .= ' WHERE';

            if (!is_null($user_id)) {
                $sql .= ' post.user_id = :user_id';
                $params = ["user_id" => $user_id];

                if (!is_null($station_id)) {
                    $sql .= ' AND post.station_id = :station_id';
                    $params += ["station_id" => $station_id];
                }
            } else {
                $sql .= ' post.station_id = :station_id';
                $params += ["station_id" => $station_id];
            }
        }

        $sql .= ' GROUP BY post.post_id ORDER BY post.creation_timestamp DESC';

        return $this->_db->sendQuery($sql, $params);
    }

    public function getFileName() : int {
        $last_id = $this->_db->sendQuery(
            'SELECT MAX(post_id) AS post_id FROM post'
        )["0"]["post_id"];

        if ($last_id == null) {
            return 1;
        } else {
            return ((int) $last_id) + 1;
        }
    }

    // ADD
    public function add(int $user_id, int $station_id, string $title, string $img_path) {
        $this->_db->sendQuery(
            'INSERT INTO post(user_id, station_id, title, creation_timestamp, img_path)
                VALUES (:user_id, :station_id, :title, :creation_timestamp, :img_path)',
            ["user_id" => $user_id, "station_id" => $station_id, "title" => $title, "creation_timestamp" => date("Y-m-d H:i:s"), "img_path" => $img_path],
            false
        );
    }

    // UPDATE

    // DELETE
    public function deleteById(int $post_id, int $user_id) {
        $this->_db->sendQuery(
            'DELETE FROM post WHERE post_id = :post_id AND user_id = :user_id',
            ["post_id" => $post_id, "user_id" => $user_id],
            false
        );
    }
}
