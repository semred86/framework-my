<?php


namespace App\core\SQLBuilder;


use Exception;

class PostgresQueryBuilder extends MysqlQueryBuilder
{

    /**
     * Помимо прочего, PostgreSQL имеет несколько иной синтаксис LIMIT.
     * @param int $start
     * @param int $offset
     * @return SQLQueryBuilder
     * @throws Exception
     */
    public function limit(int $start, int $offset): SQLQueryBuilder
    {
        parent::limit($start, $offset);

        $this->query->limit = " LIMIT " . $start . " OFFSET " . $offset;

        return $this;
    }

    // + тонны других переопределений...
}