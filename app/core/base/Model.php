<?php


namespace App\core\base;


use App\core\Db;

abstract class Model
{
    protected Db $db;
    protected string $table;

    public function __construct()
    {
        $this->db = Db::instance();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function execute(string $sql, array $params = []): bool
    {
        return $this->db->execute($sql, $params);
    }

    /**
     * @param mixed $id
     * @return bool|array
     */
    public function find(mixed $id): bool|array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1";
        return $this->db->fetch($sql, [$id]);
    }

    /**
     * @return bool|array
     */
    public function findAll(): bool|array
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->fetchAll($sql);
    }
}