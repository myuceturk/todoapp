<?php

if ($process == 'add') { // KATEGORİ EKLEME

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
} elseif ($process == 'list') { // KATEGORİ LİSTELEME
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
} elseif ($process == 'remove') { // KATEGORİ SİLME
    $query = $db->prepare("DELETE FROM categories WHERE categories.id=? && categories.user_id=?");
    $get = $query->execute([$data['id'], get_session('id')]);
    if ($query->rowCount()) {
        return [
            'success' => true,
            'type' => 'success',
            'message' => 'Kategori silme işlemi başarılı'
        ];
    } else {
        return [
            'success' => true,
            'type' => 'danger',
            'message' => 'Silme işleminde bir hata meydana geldi.',
            'data' => []
        ];
    }
} elseif ($process == 'edit') { // KATEGORİ GÜNCELLEME
    if (!$data['title']) {
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Lütfen kategoriniz için bir başlık giriniz.'
        ];
    }
    $query = $db->prepare("UPDATE categories SET categories.title=? WHERE categories.id=? && user_id=?");
    $get = $query->execute([$data['title'], $data['id'], get_session('id')]);
    if ($get) {
        return [
            'success' => true,
            'type' => 'success',
            'message' => 'Kategori güncelleme işlemi başarılı'
        ];
    } else {
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Kategori güncelleme işleminde bir hata meydana geldi!'
        ];
    }
} elseif ($process == 'getsingle') { // KATEGORİ GÜNCELLEME İÇİN BİLGİLERİ GETİRİRİYORUZ
    $query = $db->prepare("SELECT * FROM categories WHERE categories.id=? && user_id=?");
    $get = $query->execute([$data['id'], get_session('id')]);
    if ($query->rowCount()) {
        return [
            'success' => true,
            'type' => 'success',
            'data' => $query->fetch(PDO::FETCH_ASSOC)
        ];
    } else {
        return [
            'success' => true,
            'type' => 'danger',
            'data' => []

        ];
    }
}
