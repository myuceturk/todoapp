<?php

if ($process == 'list') { // ToDos LİSTELEME
    $query = $db->prepare("SELECT todos.*, c.title as category_title FROM todos LEFT JOIN categories c on c.id = todos.category_id WHERE todos.user_id=?");
    $get = $query->execute([get_session('id')]);
    if ($query->rowCount()) {
        return [
            'success' => true,
            'data' => $query->fetchAll(PDO::FETCH_ASSOC)
        ];
    } else {
        return [
            'success' => true,
            'data' => []
        ];
    }
} elseif ($process == 'getsingle') { // ToDo GÜNCELLEME İÇİN BİLGİLERİ GETİRİRİYORUZ

    $id = $data['id'];
    $user = get_session('id');

    $query = $db->query("SELECT * FROM categories WHERE user_id='$user'");
    $category = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT * FROM todos WHERE todos.id=? && todos.user_id=?");
    $get = $query->execute([$data['id'], get_session('id')]);
    if ($query->rowCount()) {
        return [
            'success' => true,
            'type' => 'success',
            'data' => array_merge($query->fetch(PDO::FETCH_ASSOC), ['categories' => $category])
        ];
    } else {
        return [
            'success' => true,
            'type' => 'danger',
            'data' => []

        ];
    }
}
