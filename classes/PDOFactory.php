<?php

class PDOFactory {
    // Singleton
    private static $_instance;

    public static function getInstance(
        int $db_type,
        string $host,
        string $dbname,
        string $port,
        string $user,
        string $password,
        string $charset = "utf8"): PDOFactory {
        if (is_null(self::$_instance)) {
            self::$_instance = new PDOFactory($db_type, $host, $dbname, $port, $user, $password, $charset);
        }

        return self::$_instance;
    }

    // Constructor
    const DATABASE_TYPE_MYSQL = 1;

    private function __construct(
        int $db_type,
        string $host,
        string $dbname,
        string $port,
        string $user,
        string $password,
        string $charset = "utf8") {
        switch ($db_type) {
            case $db_type == self::DATABASE_TYPE_MYSQL: {
                $this->_db = $this->mySql($host, $dbname, $port, $user, $password, $charset);
                break;
            }
            default: {
                $this->_db = null;
                break;
            }
        }
    }

    // Database
    private $_db;

    private function mySql(
        string $host,
        string $dbname,
        string $port,
        string $user,
        string $password,
        string $charset = "utf8"): PDO {
        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=$charset", $user, $password);

            // TODO: DELETE BEFORE UPLOADING IT TO THE WEB
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        } catch (Exception $err) {
            die($err->getCode().":".$err->getMessage());
        }
    }

    // TODO: Change return type to an object (https://stackoverflow.com/questions/37033142/is-it-possible-to-specify-multiple-return-types-on-php-7)
    public function sendQuery(string $sql, array $vars = [], bool $return = true): ?array {
        $query = $this->_db->prepare($sql);
        $result = [];

        foreach ($vars as $name => $value) {
            if (is_int($value))         $type = PDO::PARAM_INT;
            else if (is_bool($value))   $type = PDO::PARAM_BOOL;
            else                        $type = PDO::PARAM_STR;

            $query->bindValue(":$name", $value, $type);
        }

        $success = $query->execute();
        if ($return) while ($d = $query->fetch(PDO::FETCH_ASSOC)) { $result[] = $d; }

        $query->closeCursor();
        return $return ? $result : null;
    }
}
