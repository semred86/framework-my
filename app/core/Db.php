<?php


namespace App\core;


use PDO;

class Db
{
    protected PDO $pdo;
    protected static ?Db $instance = null;

    public static int $countSql = 0;
    public static array $queries = [];

    /**
     * Db constructor.
     */
    protected function __construct()
    {
        $db = require_once APP . '/config/config_db.php';
        extract($db);
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $options);
//        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * Get|Set bd instance
     * @return Db
     */
    public static function instance(): Db
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Execution SQL query
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function execute(string $sql, array $params = []): bool
    {
        self::log($sql);

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Fetch one row
     * @param string $sql
     * @param array $params
     * @return bool|array
     */
    public function fetch(string $sql, array $params = []): bool|array
    {
        self::log($sql);

        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute($params)) {
            return $stmt->fetch(/*PDO::FETCH_ASSOC*/);
        }
        return false;
    }

    /**
     * Fetch all rows
     * @param string $sql
     * @param array $params
     * @return bool|array
     */
    public function fetchAll(string $sql, array $params = []): bool|array
    {
        self::log($sql);

        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute($params)) {
            return $stmt->fetchAll(/*PDO::FETCH_ASSOC*/);
        }
        return false;
    }

    /**
     * Log queries and their number
     * @param string $sql
     */
    protected static function log(string $sql)
    {
        self::$countSql++;
        self::$queries[] = $sql;
    }
}