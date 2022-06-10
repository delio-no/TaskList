<?php

session_start();

if (!$_SESSION['login']){
    header("location: ../index.php");
    exit();
} else{
    include_once($_SERVER['DOCUMENT_ROOT'] . "/handlers/task_list.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/views/task_list.php");
}


