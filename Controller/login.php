<?php

if (route(0) == 'login') {

    if (isset($_POST['submit'])) {

        add_session('hata', value:'mesajınız eklendi');

        $email = post('email');
        $password = post('password');

        echo $email . ' ' . $password;
    }

    view('auth/login');
}
