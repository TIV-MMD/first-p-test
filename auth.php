<?php

include "bootstrap/init.php";

$home_url = site_url();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'];
    $params = $_POST;
    if ($action == 'register') {

        $result = register($params);
        if (!$result) {
            // echo "";
            message("error : an error in registration");
        } else {

            message("Registration is Successfull. Welcome to Mtask .<br>
            <a href='{$home_url}auth.php'>Please Login</a>
            ", 'success');
        }

    } elseif ($action == 'login') {
        $test = getUserByEmail($params['email']);
        dd($test);
        $result = login($params['email'], $params['password']);
        if (!$result) {
            message("error : email or password is incorrect");
        } else {
            // Redirect to main page after successful login
            // header("Location: " . site_url());
            // exit();
            header("location:" . site_url('index.php'));
            exit();
        }


    }
}
// dd($_SESSION);

// بازنویسی توابع برای حذف وابستگی به پایگاه داده
$users = [
    ["id" => 1, "name" => "admin", "email" => "admin@example.com", "password" => "1234"]
];

function register($params)
{
    global $users;
    $newUser = [
        "id" => count($users) + 1,
        "name" => $params['name'],
        "email" => $params['email'],
        "password" => $params['password']
    ];
    $users[] = $newUser;
    return true;
}

function login($email, $password)
{
    global $users;
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $_SESSION['login'] = (object) $user;
            return true;
        }
    }
    return false;
}

#connect to db and get tasks
$tasks = getTask();
include "tpl/tpl-auth.php";

//php -S localhost:8000
