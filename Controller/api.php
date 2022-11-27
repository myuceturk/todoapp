<?php

if (route(1) == 'addtodo') {
    //json_encode($_POST)

    $post = filter($_POST);
    $start_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s');

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

    if ($post['start_date_time'] && $post['start_date']) $start_date = $post['start_date'] . ' ' . $post['start_date_time'];
    if ($post['end_date_time'] && $post['end_date']) $end_date = $post['end_date'] . ' ' . $post['end_date_time'];

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

    $query = $db->prepare("INSERT INTO todos SET todos.title =?, todos.description=?, todos.color=?, todos.status=?, todos.progress=?, todos.start_date=?, todos.end_date=?,todos.category_id=?,todos.user_id=?");
    $insert = $query->execute([
        $post['title'],
        $post['description'],
        $post['color'] ?? '#007bff',
        $post['status'] ?? 'a',
        intval($post['progress']) ?? 1,
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
} elseif (route(1) == 'edittodo') {
    //json_encode($_POST)


    $post = filter($_POST);
    $start_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s');

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

    if ($post['start_date_time'] && $post['start_date']) $start_date = $post['start_date'] . ' ' . $post['start_date_time'];
    if ($post['end_date_time'] && $post['end_date']) $end_date = $post['end_date'] . ' ' . $post['end_date_time'];

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

    $query = $db->prepare("UPDATE todos SET todos.title=?, todos.description=?, todos.color=?, todos.status=?, todos.progress=?, todos.start_date=?, todos.end_date=?,todos.category_id=? WHERE todos.id=? && todos.user_id=?");
    $update = $query->execute([
        $post['title'],
        $post['description'],
        $post['color'] ?? '#007bff',
        $post['status'] ?? 'a',
        intval($post['progress']) ?? 1,
        $start_date,
        $end_date,
        $post['category_id'] ?? 0,
        $post['id'],
        get_session('id')
    ]);

    if ($update) {
        $status = 'success';
        $title = 'Güncelleme Başarılı';
        $message = 'ToDo başarıyla güncellendi';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message, 'redirect' => url('todo/list')]);
        exit();
    } else {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Beklenmedik bir hata meydana geldi';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
} elseif (route(1) == 'removetodo') {
    // $status = 'error';
    // $title = 'Ops! Dikkat';
    // $message = 'Beklenmedik bir hata meydana geldi';
    // echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
    // exit();

    $post = filter($_POST);
    if (!$post['id']) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'ID bilgisi alınamadı.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }

    $user = get_session('id');
    $id = $post['id'];
    $q = $db->query("DELETE FROM todos WHERE todos.id= '$id' && todos.user_id = '$user'");
    if ($q) {
        $status = 'success';
        $title = 'Başarılı';
        $message = 'ToDo listeleden kaldırıldı.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message,  'id' => $id]);
        exit();
    } else {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Bir hata meydana geldi.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
} elseif (route(1) == 'calendar') {
    $start = get('start');
    $end = get('end');

    $sql = "SELECT id, title, color, start_date as start, end_date as end, CONCAT('/Projects/ToDo/todo/edit/',todos.id) as url
    FROM todos WHERE todos.user_id=?";

    if ($start &&  $end) {
        $sql .= "&& (start_date BETWEEN '$start' and '$end' OR end_date BETWEEN '$start' and '$end')";
    }

    $query = $db->prepare($sql);
    $get = $query->execute([get_session('id')]);
    $array = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($array);
}


if (route(1) == 'profile') {
    $post = filter($_POST);

    if (!$post['name']) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Lütfen adınızı giriniz.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
    if (!$post['surname']) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Lütfen soyadınızı giriniz.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
    if (!$post['email']) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Lütfen e-posta giriniz.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }

    $id = get_session('id');
    $name = $post['name'];
    $surname = $post['surname'];
    $email = $post['email'];
    $concatName = $name . ' ' . $surname;

    $update = $db->query("UPDATE users SET name='$name', surname='$surname', email='$email' WHERE users.id ='$id'");
    if ($update) {

        add_session('name', $name);
        add_session('surname', $surname);
        add_session('email', $email);
        add_session('fullname', $concatName);

        $status = 'success';
        $title = 'Başarılı';
        $message = 'Profil güncellendi.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    } else {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Bir hata meydana geldi';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
}
if (route(1) == 'changepassword') {
    $post = filter($_POST);

    if (!$post['old_password'] || (get_session('password') != md5($post['old_password']))) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Lütfen şuanda kullanmakta olduğunuz şifreyi doğru giriniz';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }

    $lower = preg_match('#[a-z]#', $post['password']);
    $upper = preg_match('#[A-Z]#', $post['password']);
    $number = preg_match('#[0-9]#', $post['password']);

    if (!$post['password'] || !$lower || !$upper || !$number || strlen($post['password']) < 6) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Şifreniz en az 6 karakter, büyük, küçük harf ve sayı içermelidir.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }

    if (!$post['password'] || !$post['password_again'] || ($post['password'] != $post['password_again'])) {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Yeni şifreniz birbiri ile uyuşmuyor.';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }

    $p = md5($post['password']);
    $id = get_session('id');
    $update = $db->query("UPDATE users SET password='$p' WHERE users.id ='$id'");
    if ($update) {
        add_session('password', $p);

        $status = 'success';
        $title = 'Başarılı';
        $message = 'Şifreniz güncellendi. Giriş sayfasına yönlendiriliyorsunuz!';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message, 'redirect' => url('logout')]);
        exit();
    } else {
        $status = 'error';
        $title = 'Ops! Dikkat';
        $message = 'Bir hata meydana geldi';
        echo json_encode(['status' => $status, 'title' => $title, 'message' => $message]);
        exit();
    }
}
