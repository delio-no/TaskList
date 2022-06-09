<?php


//выборка description пользователя
function getDescriptionTaskList($userId)
{
    $stmt = connect()->prepare("SELECT task.description FROM task INNER JOIN user ON task.user_id = user.user_id WHERE user.user_id = (?)");
    if (!$stmt->execute(array($userId))) {
        $stmt = null;
        header("location: ../task_list.php?error=getDescriptionTaskList");
        exit;
    }
    return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}


//выборка task_id у Task
function getIdTask($userId)
{
    $stmt = connect()->prepare("SELECT task.task_id FROM task INNER JOIN user ON task.user_id = user.user_id WHERE user.user_id = (?)");
    if (!$stmt->execute(array($userId))) {
        $stmt = null;
        header("location: ../task_list.php?error=getIdTaskList");
        exit;
    }
    return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}


//выборка status у TaskList
function getStatusTaskList($userId)
{
    $stmt = connect()->prepare("SELECT task.status FROM task INNER JOIN user ON task.user_id = user.user_id WHERE user.user_id = (?)");
    if (!$stmt->execute(array($userId))) {
        $stmt = null;
        header("location: ../task_list.php?error=getStatusTaskList");
        exit;
    }
    return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}


//вставка description пользователя
function setDescriptionTask($userId, $description)
{
    $stmt = connect()->prepare("INSERT INTO task (user_id, description, status) VALUES (?, ?, ?)");
    if (!$stmt->execute(array($userId, $description, 'unchecked'))) {
        $stmt = null;
        header("location: ../task_list.php?error=getTaskListFailed");
        exit;
    }
    $stmt = null;
}


//удаление определенного таска из листа
function deleteIdTask($idTask)
{
    $stmt = connect()->prepare("DELETE FROM task WHERE task_id = (?)");
    if (!$stmt->execute(array($idTask))) {
        $stmt = null;
        header("location: ../task_list.php?error=deleteIdTaskList");
        exit;
    }
    $stmt = null;
}


//удаление всего списка
function deleteTaskList($userId)
{
    $stmt = connect()->prepare("DELETE FROM task WHERE user_id = (?)");
    if (!$stmt->execute(array($userId))) {
        $stmt = null;
        header("location: ../task_list.php?error=deleteIdTaskList");
        exit;
    }
    $stmt = null;
}

//апдейт статуса task на ready
function statusReadyTask($idTask)
{
    $stmt = connect()->prepare("UPDATE task SET status = IF (status = 'unchecked', 'checked', status) WHERE task_id = (?)");
    if (!$stmt->execute(array($idTask))) {
        $stmt = null;
        header("location: ../task_list.php?error=deleteIdTaskList");
        exit;
    }
    $stmt = null;
}


//апдейт статуса task на unready
function statusUnReadyTask($idTask)
{
    $stmt = connect()->prepare("UPDATE task SET status = IF (status = 'checked', 'unchecked', status) WHERE task_id = (?)");
    if (!$stmt->execute(array($idTask))) {
        $stmt = null;
        header("location: ../task_list.php?error=deleteIdTaskList");
        exit;
    }
    $stmt = null;
}




