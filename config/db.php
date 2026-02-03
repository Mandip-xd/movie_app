<?php
ini_set('display_errors', '0');
ini_set('log_errors', '1');

$host = 'localhost';
$db   = 'np03cs4s250044';
$user = 'np03cs4s250044';
$pass = 'FG5urnZ8Aa';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed');
}
