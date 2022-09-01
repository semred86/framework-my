<?php


namespace App\core\logger;


interface Logger
{
    public static function log(string $query): void;
}