<?php

const BASEDIR = 'C:\xampp\htdocs\Projects\ToDo';
const URL = 'http://localhost/Projects/ToDo/';
const DEV_MODE = true;

try {
    $db = new PDO('mysql:host=localhost;dbname=todoapp;', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}
