<?php

try {
    // ifi $database_config was object: $database_config->db
    $dsn = "mysql:dbname=mtask;host=localhost";

    $pdo = new PDO($dsn, 'root', '');
} catch (PDOException $e) {
    diepage("❌ error: " . $e->getMessage() . " in line " . $e->getLine());
}
