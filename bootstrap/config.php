<?php

$database_config = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db' => 'mtask'
];

try {
    // ifi $database_config was object: $database_config->db
    $dsn = "mysql:dbname={$database_config['db']};host={$database_config['host']}";

    $pdo = new PDO($dsn, $database_config['user'], $database_config['pass']);
} catch (PDOException $e) {
    diepage("❌ error: " . $e->getMessage() . " in line " . $e->getLine());
}
