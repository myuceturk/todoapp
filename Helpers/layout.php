<?php


function status($status)
{
    if ($status == 'a') {
        return [
            'title' => 'Aktif',
            'color' => 'success',
            'icon' => 'fa fa-check'
        ];
    } elseif ($status == 'p') {
        return [
            'title' => 'Pasif',
            'color' => 'danger',
            'icon' => 'fa fa-pause'
        ];
    } elseif ($status == 's') {
        return [
            'title' => 'Süreçte',
            'color' => 'warning',
            'icon' => 'fa fa-play'
        ];
    }
}
