<?php

class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        // ==== Создаем объект класса ПДО передав в конструктор параметры соединения ====
        $dsn = "mysql:host={$params['host']}; dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        return $db;
    }
}