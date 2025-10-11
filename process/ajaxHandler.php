<?php

include __DIR__ . '/../bootstrap/init.php';


if (!isAjaxRequest()) {
    diepage("invalid request!");
}
if (!isset($_POST['action']) or empty($_POST['action'])) {
    diepage("invalid action!");
}


switch ($_POST['action']) {
    case "doneSwitch":
        // dd($_POST);
        $task_id = $_POST['taskId'];
        if (!isset($task_id) || !is_numeric($task_id)) {
            echo "آیدی تسک معتبر نیست";
            die();
        }
        doneSwith($task_id);
        break;


    case "addFolder":
        if (!isset($_POST['folderName']) or  strlen($_POST['folderName']) < 3) {
            echo json_encode('bigger than 2!');
            die();
        }
        $newId = addFolders($_POST['folderName']);
        echo json_encode([
                'status' => 'success',
                'id' => $newId,
                'name' => $_POST['folderName']
            ]);
        break;
    case "addTask":

        $folderId =  $_POST['folderId'];
        $taskTitle = $_POST['taskTitle'];
        if (!isset($folderId) or empty($folderId)) {
            echo json_encode(['status' => 0, 'message' => 'select folder!']);
            die();
        }
        if (!isset($taskTitle) or strlen($taskTitle) < 3) {
            echo json_encode(['status' => 0, 'message' => 'task name should be bigger than 3!']);
            die();
        }
        $taskId = addTask($taskTitle, $folderId);
        echo json_encode(['status' => 1, 'id' => $taskId]);
        break;
    default:
        echo json_encode([ 'status' => 0,'message' => 'invalid action!']);
        die();
}
