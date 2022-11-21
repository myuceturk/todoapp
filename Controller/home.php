<?php

if (!get_session('login') || get_session('login') != true) redirect('login');

if (route(0) == 'home') {
    view('home/home');
}
