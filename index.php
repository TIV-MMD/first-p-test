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

// تعریف آرایه‌ها برای ذخیره داده‌ها
$tasks = [
    ["id" => 1, "name" => "Task 1", "completed" => false],
    ["id" => 2, "name" => "Task 2", "completed" => true],
];

$folders = [
    ["id" => 1, "name" => "Folder 1"],
    ["id" => 2, "name" => "Folder 2"],
];

// حذف توابع پایگاه داده و استفاده از آرایه‌ها
function getTask()
{
    global $tasks;
    return $tasks;
}

function getFolders()
{
    global $folders;
    return $folders;
}

function deletFolder($folderId)
{
    global $folders;
    $folders = array_filter($folders, function ($folder) use ($folderId) {
        return $folder['id'] != $folderId;
    });
    return 1; // تعداد حذف شده‌ها
}

function deletTask($taskId)
{
    global $tasks;
    $tasks = array_filter($tasks, function ($task) use ($taskId) {
        return $task['id'] != $taskId;
    });
    return 1; // تعداد حذف شده‌ها
}

include 'tpl/tpl-index.php';
