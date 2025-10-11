<?php


session_start();
include "constans.php";


include __DIR__ . '/../vendor/autoload.php';
include __DIR__ ."/../libs/helper.php";
include "config.php";

include __DIR__ . "/../libs/lib-auth.php";
include __DIR__ . "/../libs/lib-tasks.php";
// echo "__DIR__: " . __DIR__ . "<br>";
// echo "getcwd(): " . getcwd() . "<br>";


// // تعریف مسیر پروژه (یک پوشه بالاتر از init.php)
// define('BASE_PATH', realpath(__DIR__ . '/../'));

// // لود فایل‌هایی که داخل فولدر bootstrap هستند
// include BASE_PATH . '/bootstrap/constans.php';              // چون در همون فولدر است
// include BASE_PATH . '/bootstrap/config.php';                // هم در bootstrap است

// // فایل‌هایی که خارج از فولدر bootstrap هستند
// include BASE_PATH . '/vendor/autoload.php';
// include BASE_PATH . '/libs/helper.php';

// try{
//     // ifi $database_config was object: $database_config->db
//     $dsn = "mysql:dbname={$database_config['db']};host={$database_config['host']}";

//     $dbh = new PDO($dsn, $database_config['user'],$database_config['pass']);
// } catch( PDOException $e){
//     diepage("❌ error: " . $e->getMessage() . " in line " . $e->getLine());
// }
// echo "✔ connection is ok";

// // ادامه لود بقیه فایل‌ها
// include BASE_PATH . '/libs/lib-auth.php';
// include BASE_PATH . '/libs/lib-tasks.php';
