<?php


//выборка description пользователя
function getDescriptionTaskList($userId)
{
    $stmt = connect()->prepare("SELECT task.description, task.status FROM task INNER JOIN user ON task.user_id = user.user_id WHERE user.user_id = (?)");
    if (!$stmt->execute(array($userId))) {
        $stmt = null;
        header("location: ../task_list.php?error=getTaskListFailed");
        exit;
    }
    return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}

//вставка description пользователя
function setDescriptionTaskList($userId, $description)
{
    $stmt = connect()->prepare("INSERT INTO task (user_id, description, status) VALUES (?, ?, ?)");
    if (!$stmt->execute(array($userId, $description, 'unchecked'))) {
        $stmt = null;
        header("location: ../task_list.php?error=getTaskListFailed");
        exit;
    }
    $stmt = null;
}