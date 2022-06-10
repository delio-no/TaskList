<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . "/config_db.php");


$userId = intval($_SESSION['id_user']);


//реализуем добавление task
if (isset($_POST['btnadd'])) {
    $work = $_POST['work'];
    if (!empty($_POST['work'])){
        setDescriptionTask($userId, $work);
    }
    header("location: ../index.php");
    exit;
}


//реализуем удаление всего списка дел
if (isset($_POST['btnrmall'])) {
    deleteTaskList($userId);
    header("location: ../index.php");
    exit;
}


//реализуем удаление орпеделенного task
if (isset($_POST['btnrm'])) {
    $idTask = $_POST['btnrm'];
    deleteIdTask($idTask);
    header("location: ../index.php");
    exit;
}


//изменяем статус на ready
if (isset($_POST['btnrd'])) {
    $idTask = $_POST['btnrd'];
    statusReadyTask($idTask);
    header("location: ../index.php");
    exit;
}

//изменяем статус на unready
if (isset($_POST['btnunrd'])) {
    $idTask = $_POST['btnunrd'];
    statusUnReadyTask($idTask);
    header("location: ../index.php");
    exit;
}


//выборка description пользователя
function getDescriptionTaskList($userId)
{
    $stmt = $GLOBALS['db']->prepare("SELECT task.description FROM task INNER JOIN user ON task.user_id = user.user_id WHERE user.user_id = (?)");
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
    $stmt = $GLOBALS['db']->prepare("SELECT task.task_id FROM task INNER JOIN user ON task.user_id = user.user_id WHERE user.user_id = (?)");
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
    $stmt = $GLOBALS['db']->prepare("SELECT task.status FROM task INNER JOIN user ON task.user_id = user.user_id WHERE user.user_id = (?)");
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
    $stmt = $GLOBALS['db']->prepare("INSERT INTO task (user_id, description, status) VALUES (?, ?, ?)");
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
    $stmt = $GLOBALS['db']->prepare("DELETE FROM task WHERE task_id = (?)");
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
    $stmt = $GLOBALS['db']->prepare("DELETE FROM task WHERE user_id = (?)");
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
    $stmt = $GLOBALS['db']->prepare("UPDATE task SET status = IF (status = 'unchecked', 'checked', status) WHERE task_id = (?)");
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
    $stmt = $GLOBALS['db']->prepare("UPDATE task SET status = IF (status = 'checked', 'unchecked', status) WHERE task_id = (?)");
    if (!$stmt->execute(array($idTask))) {
        $stmt = null;
        header("location: ../task_list.php?error=deleteIdTaskList");
        exit;
    }
    $stmt = null;
}


