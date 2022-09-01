<?php


namespace App\core\logger;


class DbLogger implements Logger
{
    protected static int $countSql = 0;
    protected static array $queries = [];

    public static function log(string $query): void
    {
        self::$countSql++;
        self::$queries[] = $query;
    }

    /**
     * @return int
     */
    public static function getCountSql(): int
    {
        return self::$countSql;
    }

    /**
     * @param int $countSql
     */
    public static function setCountSql(int $countSql): void
    {
        self::$countSql = $countSql;
    }

    /**
     * @return array
     */
    public static function getQueries(): array
    {
        return self::$queries;
    }

    /**
     * @param array $queries
     */
    public static function setQueries(array $queries): void
    {
        self::$queries = $queries;
    }
}