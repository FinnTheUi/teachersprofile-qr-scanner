<?php
try {
    $host = '127.0.0.1';
    $db   = 'lnu_qr_scanner';
    $user = 'root';
    $pass = 'LnuQr2024!';
    $port = "3306";
    $charset = 'utf8mb4';

    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    $pdo = new \PDO($dsn, $user, $pass, $options);
    echo "Successfully connected to MySQL!\n";
    echo "MySQL version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n";
} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}