<?php

if (!get_session('login') || get_session('login') != true) redirect('login');

if (route(0) == 'categories' && !route(1)) {

    // if (isset($_POST['submit'])) {

    //     $_SESSION['post'] = $_POST;

    //     $email = post('email');
    //     $password = post('password');
    //     $return = model('auth/login', ['email' => $email, 'password' => $password], 'login');

    //     if ($return['success'] == true) {
    //         if (isset($return['redirect'])) redirect($return['redirect']);
    //     } else {
    //         add_session('error', [
    //             'message' => $return['message'] ?? '',
    //             'type' => $return['type'] ?? '',
    //         ]);
    //     }
    // }

    view('categories/home');
} elseif (route(0) == 'categories' && route(1) == 'add') {

    if (isset($_POST['submit'])) {

        $_SESSION['post'] = $_POST;
        $title = post('title');

        $return = model('categories', ['title' => $title], 'add');

        if ($return['success'] == true) {
            if (isset($return['redirect'])) redirect($return['redirect']);
        } else {
            add_session('error', [
                'message' => $return['message'] ?? '',
                'type' => $return['type'] ?? '',
            ]);
        }
    }

    view('categories/add');
} elseif (route(0) == 'categories' && route(1) == 'list') {

    $return = model('categories', [], 'list');

    view('categories/list', $return['data']);
} elseif (route(0) == 'categories' && route(2) == 'edit' && is_numeric(route(2))) {
    view('categories/edit');
}
