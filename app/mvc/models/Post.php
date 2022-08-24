<?php


namespace App\mvc\models;


use App\core\base\Model;

class Post extends Model
{
    public string $table = 'post';


    /**
     * @param array $params
     * @return bool
     */
    public function update(array $params): bool
    {
        $sql = "UPDATE {$this->table} SET title=:title, body=:body WHERE id=:id";
        return $this->execute($sql, $params);
    }

    /**
     * @param array $params
     * @return bool
     */
    public function add(array $params): bool
    {
        $sql = "INSERT INTO {$this->table} (title, body) VALUES (:title, :body)";
        return $this->execute($sql, $params);
    }

    /**
     * @param array $params
     * @return bool
     */
    public function delete(array $params): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->execute($sql, $params);
    }
}