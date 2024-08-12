<?php
//namespace Traits;

/**
 * Database traits
 * @param Database::$instance
 */
class Database {
    public $dbh;
    private $stmt;
    public static $instance = null;

    public function __construct() {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
            \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_EMPTY_STRING,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];

        $dns = app('database', 'driver') .
        ':host=' . app('database', 'host') .
        ((!empty(app('database', 'port'))) ? (';port=' . app('database', 'port')) : '') .
        ';dbname=' . app('database', 'schema');

        $this->dbh = new PDO($dns, app('database', 'username'), app('database', 'password'), $options);

        return $this->dbh;
    }

    public static function connect() {
        $dns = app('database', 'driver') .
        ':host=' . app('database', 'host') .
        ((!empty(app('database', 'port'))) ? (';port=' . app('database', 'port')) : '') .
        ';dbname=' . app('database', 'schema');

        if(self::$instance === null) {
            self::$instance = new PDO($dns, app('database', 'username'), app('database', 'password'), [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_EMPTY_STRING,
                \PDO::ATTR_EMULATE_PREPARES => false
            ]);
        }

        return self::$instance;
    }

    public function query(string $query, array $data = []): mixed {
        //$db = $this->connect();
        $this->stmt = $this->dbh->prepare($query);

        if($this->stmt->execute($data)) {
            $result = $this->stmt->fetchAll(\PDO::FETCH_OBJ);
            if(is_array($result) && count($result)) return $result;
        }

        /**
         * Close session from db and return null result
         */
        $this->dbh = null;
    }

    public function query_result_array(string $query): mixed {
        $this->stmt = $this->dbh->prepare($query);
        $this->stmt->execute();
        if($this->stmt->execute()) {
            $result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(is_array($result) && count($result)) return $result;
        }

        /**
         * Close session from db and return null result
         */
        $this->dbh = null;
    }
}