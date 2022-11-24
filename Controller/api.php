<?php

if (route(1) == 'addtodo') {
    //json_encode($_POST)

    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d');

    $post = filter($_POST);

    if (!$post['title']) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Lütfen bir başlık giriniz';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
    if (!$post['description']) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Lütfen bir açıklama giriniz';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }

    if ($post['start_date_time']) $start_date = $start_date . ' ' . $post['start_date_time'];
    if ($post['end_date_time']) $end_date = $end_date . ' ' . $post['end_date_time'];

    if ($post['category_id']) {
        $uid = get_session('id');
        $cid = $post['category_id'];
        $select = $db->query("SELECT id FROM categories WHERE user_id='$uid' && categories.id='$cid'");
        $sResult = $select->fetch(PDO::FETCH_ASSOC);
        if (!$sResult) {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $message = 'Seçili kategori bulunamadı!';
            echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
            exit();
        }
    }

    $query = $db->prepare("INSERT INTO todos SET todos.title =?, todos.description=?, todos.color=?, todos.start_date=?, todos.end_date=?,todos.category_id=?,todos.user_id=?");
    $insert = $query->execute([
        $post['title'],
        $post['description'],
        $post['color'] ?? '#007bff',
        $start_date,
        $end_date,
        $post['category_id'] ?? 0,
        get_session('id')
    ]);

    if ($insert) {
        $status = 'success';
        $title = 'Ekleme Başarılı';
        $message = 'ToDo başarıyla eklendi';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message, 'redirect' => url('todo/list')]);
        exit();
    } else {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Beklenmedik bir hata meydana geldi';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
}
