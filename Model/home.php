<?php

if ($process == 'list') { // ToDos LİSTELEME

    $query = $db->prepare("SELECT todos.*, c.title as category_title FROM todos LEFT JOIN categories c on c.id = todos.category_id WHERE todos.user_id=? && status=? ORDER BY start_date ASC");
    $query->execute([get_session('id'), 's']);
    $todos = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT status, count(todos.id) as toplam,
                            (count(todos.id) * 100 / (SELECT COUNT(id) FROM todos WHERE user_id=? )) as yuzde
                            FROM todos WHERE todos.user_id=?
                            GROUP BY todos.status");
    $get = $query->execute([get_session('id'), get_session('id')]);
    if ($query->rowCount()) {
        return [
            'success' => true,
            'data' => array_merge(['statistics' => $query->fetchAll(PDO::FETCH_ASSOC)], ['surec' => $todos])
        ];
    } else {
        return [
            'success' => true,
            'data' => []
        ];
    }
}
