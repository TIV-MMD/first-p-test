<?php

function getCurrntUserId()
{
    return isset($_SESSION['login']) ? $_SESSION['login']->id : null;
    // return 1;
}
function getUserByEmail($email)
{
    global $users;
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return (object) $user;
        }
    }
    return null;


}
function login($email, $pass)
{
    $user = getUserByEmail($email);
    if (is_null($user)) {
        return false;
    }
    if (password_verify($pass, $user->password)) {
        #login is successful
        $_SESSION['login'] = $user;

        // dd($_SESSION);
        return true;
    }
    return false;

}
function isLoggedIn()
{
    return isset($_SESSION['login']) ? true : false;
}

function getLogInedUser()
{

    return $_SESSION['login'] ?? null;
}

function register($userData)
{
    global $pdo;
    #validation of $userData here (isValidEmail,isValidUserName , isValidPassword)
    $pass = password_hash($userData['password'], PASSWORD_BCRYPT);
    $sql = "insert into users (name,email,password) values (:name,:email,:password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name' => $userData['name'],':email' => $userData['email'],':password' => $pass]);
    return $stmt->rowCount() ? true : false ;
}

function logout()
{
    unset($_SESSION['login']);
}
