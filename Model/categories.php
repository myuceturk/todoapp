<?php

if ($process == 'add') {

    if (!$data['title']) {
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Lütfen kategoriniz için bir başlık giriniz.'
        ];
    }

    $query = $db->prepare("INSERT INTO categories SET title=?, user_id=?");
    $query->execute([$data['title'], get_session('id')]);
    if ($query->rowCount()) {
        return [
            'success' => true,
            'type' => 'success',
            'message' => 'Kategori başarıyla eklendi',
            'redirect' => 'categories/list'
        ];
    } else {
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Kategori eklenirken bir hata meydana geldi!'
        ];
    }
} elseif ($process == 'list') {
    $query = $db->prepare("SELECT * FROM categories WHERE user_id=?");
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
}
