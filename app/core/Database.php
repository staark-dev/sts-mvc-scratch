<?php
class Database {
    private $dbh;
    private $stmt;
    private static $db;

    public function __construct($file = 'config.ini') {
        if (!$config = parse_ini_file(basename('/app') . "/config/" . $file, TRUE)) 
            throw new exception('Unable to open ' . $file . '.');

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $dns = $config['database']['driver'] .
        ':host=' . $config['database']['host'] .
        ((!empty($config['database']['port'])) ? (';port=' . $config['database']['port']) : '') .
        ';dbname=' . $config['database']['schema'];

        $this->dbh = new PDO($dns, $config['database']['username'], $config['database']['password'], $options);

        //return $this->dbh;
    }

    public function query(string $query = null) {
        $this->stmt = $this->dbh->prepare($query);
        $this->stmt->execute();
    }

    public function query_result(string $query) {
        $this->stmt = $this->dbh->prepare($query);
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert(string $table, array $data = []): bool
    {
        if(is_array($data)) {
            $values = "'" . implode ( "', '", array_values($data)) . "'";

            $this->stmt = $this->dbh->prepare("INSERT INTO `$table` (". implode(', ', array_keys($data)) .") VALUES ($values)");
            $this->stmt->execute();
            return true;
        }

        return false;
    }

    public static function open() {
        if(self::$db === null) self::$db = new Database();

        return self::$db;
    }

    public static function close() {
        if(isset(self::$db)) {
            self::$db->dbh = null;
            self::$db->stmt = null;
            self::$db->db = null;
        } 
    }
}