<?php


namespace App\core\SQLBuilder;


interface SQLQueryBuilder
{
    /**
     * @param string $table
     * @param array $fields
     * @return SQLQueryBuilder
     */
    public function select(string $table, array $fields): SQLQueryBuilder;

    /**
     * @param string $field
     * @param string $value
     * @param string $operator
     * @return SQLQueryBuilder
     */
    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder;

    /**
     * @param int $start
     * @param int $offset
     * @return SQLQueryBuilder
     */
    public function limit(int $start, int $offset): SQLQueryBuilder;

    // +100 других методов синтаксиса SQL...

    /**
     * @return string
     */
    public function getSQL(): string;
}