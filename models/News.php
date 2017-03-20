<?php

class News
{
    public static function getNewsItemById($id)
    {
        $id = intval($id);
        if ($id) {

            $result = $db->query('SELECT * FROM news WHERE id=' . $id);

            //$result->setFetchMode(PDO::FETCH_NUM); // оставляем индексы в виде нумеров колонок
            $result->setFetchMode(PDO::FETCH_ASSOC); // оставляем индексы в виде ключей

            $newsItem = $result->fetch();

            return $newsItem;
        }

    }

    public static function getNewsList()
    {
        $db = Db::getConnection();
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