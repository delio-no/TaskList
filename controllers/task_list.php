<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT']."/config_db.php");
include_once($_SERVER['DOCUMENT_ROOT']."/models/task_list.php");

$userId = intval($_SESSION['id_user']);

/*if ($_POST['work']) {
    $work = $_POST['work'];
    echo "good";
    $_POST['work'] = null;
}*/

if (isset($_POST['btnadd'])) {
    //echo 'good';
    $work = $_POST['work'];
    setDescriptionTaskList($userId, $work);
}

if (isset($_POST['btnrm'])) {

}
