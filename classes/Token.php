<?php

class Token {
    // Attributes
    private $_db;

    // Constructor
    public function __construct(PDOFactory $db) {
        $this->_db = $db;
    }

    // GET
    public function getTokenBySelector(string $selector): array {
	return $this->_db->sendQuery(
	    'SELECT
		token_id,
		user_id,
		selector,
		token,
		expires
	    FROM
		tokens
	    WHERE
		selector = :selector',
	    ["selector" => $selector]
	);
    }

    public function authTokenMatch(string $auth_token, string $token): bool {
	return hash_equals($token, hash("sha256", base64_decode($auth_token)));
    }

    public function isNotExpired(string $expires): bool {
	$exp = new DateTime($expires);
	$now = new DateTime();

	return $now < $exp;
    }

    // ADD
    public function create(int $user_id): array {
	$selector = base64_encode(random_bytes(9));
	$authenticator = random_bytes(33);

	$this->_db->sendQuery(
	    'INSERT INTO
		tokens (user_id, selector, token, expires)
	    VALUES
		(:user_id, :selector, :token, :expires)',
	    ["user_id" => $user_id, "selector" => $selector, "token" => hash("sha256", $authenticator), "expires" => date("Y-m-d\TH:i:s", time() + 15768000)],
	    false
	);

	return ["selector" => $selector, "authenticator" => base64_encode($authenticator)];
    }

    // UPDATE

    // DELETE
    public function deleteBySelector(string $selector) {
	return $this->_db->sendQuery(
	    'DELETE FROM tokens
	     WHERE selector = :selector',
	    ["selector" => $selector],
	    false
	);
    }
}
