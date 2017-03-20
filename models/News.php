<?php

class News
{
    public static function getNewsItemById($id)
    {

    }

    public static function getNewsList()
    {
        $host = 'localhost';
        $dbname = 'mvc_site';
        $user = 'root';
        $password = ''; /*
 ================== Задаем параметры соединения с БД =========== */

        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); /*
 ================== Создаем объект класса ПДО передав в конструктор параметры соединения =====*/

        $newsList = []; /*
 =========== Создаем пустой массив для результатов ===========*/

        $result = $db->query('SELECT id, title, date, short_content '
            . 'FROM news '
            . 'ORDER BY date DESC '
            . 'LIMIT 10'); /*
 ============ Описываем нужный запрос к БД ==============*/

        $i = 0;

        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            ++$i;
        }
        return $newsList;

    }
}