<?php



defined('BASE_URL') or die("premision denied");







/** Folder Functions */
function deletFolder($folder_id)
{
    global $folders;
    $folders = array_filter($folders, function ($folder) use ($folder_id) {
        return $folder['id'] != $folder_id;
    });
    return 1; // تعداد حذف شده‌ها
}
function deletTask($task_id)
{
    global $tasks;
    $tasks = array_filter($tasks, function ($task) use ($task_id) {
        return $task['id'] != $task_id;
    });
    return 1; // تعداد حذف شده‌ها
}
function getFolders()
{
    global $folders;
    return $folders;
}
function addFolders($folder_name)
{
    global $pdo;
    $current_user_id = getCurrntUserId();
    $sql = "insert into folders (name,user_id) values (:folder_name,:user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folder_name' => $folder_name,':user_id' => $current_user_id]);
    return $pdo->lastInsertId();
}
function addTask($taskTitle, $folderId)
{
    global $pdo;
    $current_user_id = getCurrntUserId();
    $sql = "insert into tasks (title,user_id,folder_id) values (:title,:user_id,:folderId)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title' => $taskTitle,':user_id' => $current_user_id,'folderId' => $folderId]);
    return $pdo->lastInsertId();
}
/** task functions */
function getTask()
{
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
    $params = [':user_id' => getCurrntUserId()];

    if (isset($folder) && is_numeric($folder)) {
        $sql .= " AND folder_id = :folder_id";
        $params[':folder_id'] = $folder;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function doneSwith($task_id)
{
    global $pdo;
    $current_user_id = getCurrntUserId();
    $sql = "Update `tasks` set is_done = 1 - is_done where user_id = :userID and id = :taskID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':taskID' => $task_id,':userID' => $current_user_id]);
    return $stmt->rowCount();
}
