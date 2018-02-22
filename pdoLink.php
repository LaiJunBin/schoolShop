<?php
    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $dbname = 'school';
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn,$user,$pass);
    $db->exec('set names utf8');
?>