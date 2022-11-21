<?php

if ($process == 'login') {


    if (!$data['email']) {
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Lütfen E-Posta Adresinizi Giriniz'
        ];
    }
    if (!$data['password']) {
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Lütfen Şifrenizi Adresinizi Giriniz'
        ];
    }

    $query = $db->prepare("SELECT *, CONCAT(name,' ',surname) as fullname FROM users WHERE email=? && password=?");
    $query->execute([$data['email'], md5($data['password'])]);
    if ($query->rowCount()) {
        $user = $query->fetch(PDO::FETCH_ASSOC);
        add_session('id', $user['id']);
        add_session('name', $user['name']);
        add_session('surname', $user['surname']);
        add_session('email', $user['email']);
        add_session('fullname', $user['fullname']);
        add_session('login', true);

        return [
            'success' => true,
            'type' => 'success',
            'message' => 'Giriş Başarılı',
            'data' => $user,
            'redirect' => 'home'
        ];
    } else {
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Kullanıcı Adı veya Şifreniz Hatalı!'
        ];
    }
}
