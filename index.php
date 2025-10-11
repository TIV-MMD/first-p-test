<?php

include 'bootstrap/init.php';


if (isset($_GET['logout'])) {
    logout();
}



if (!isLoggedIn()) {

    //redirect to aut form
    header("location:" . site_url('auth.php'));
}

if (isset($_GET['delet_folder']) && is_numeric($_GET['delet_folder'])) {
    $deletedCount = deletFolder($_GET['delet_folder']);
    // echo "$deletedCount folders succesfully deleted";
}

if (isset($_GET['delet_task']) && is_numeric($_GET['delet_task'])) {
    $deletedCount = deletTask($_GET['delet_task']);
    // echo "$deletedCount folders succesfully deleted";
}
// connect to db and get tasks
$tasks = getTask();
$folders = getFolders();
// dd($_SESSION);
// var_dump($_POST);
// var_dump($folders[0]->name);
include 'tpl/tpl-index.php';
