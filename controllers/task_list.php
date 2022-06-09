<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . "/config_db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/task_list.php");

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


