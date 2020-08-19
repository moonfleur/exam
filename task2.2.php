<?php

$host = '127.0.0.1';
$db   = 'exam_v1';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (Exception $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

$query = "DELETE FROM `customers` WHERE СNUM = :cnum";
$params = [
    'cnum' => '1101',
];

$stmt = $pdo->prepare($query);
$result = $stmt->execute($params);