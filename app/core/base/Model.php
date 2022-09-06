<?php


namespace App\core\base;


use App\core\Db;
use App\core\SQLBuilder\MysqlQueryBuilder;

abstract class Model
{
    protected Db $db;
    protected string $table;
    protected MysqlQueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->db = Db::instance();
        $this->queryBuilder = new MysqlQueryBuilder();
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
        $sql = $this->queryBuilder
            ->select($this->table, ["*"])
            ->where("id", "?")
            ->limit(0, 1)
            ->getSQL();
        return $this->db->fetch($sql, [$id]);
    }

    /**
     * @return bool|array
     */
    public function findAll(): bool|array
    {
        $sql = $this->queryBuilder
            ->select($this->table, ["*"])
            ->getSQL();
        return $this->db->fetchAll($sql);
    }
}