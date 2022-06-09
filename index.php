<?php

ob_start();

session_start();

include_once "config_db.php";

if (empty($_SESSION)) {
    //include_once "models/signup.php";
    include_once "views/signup.php";
}

if (!empty($_SESSION['message'])) {
    foreach ($_SESSION['message'] as $value) {
        echo <<<MESSAGE
<div>{$value}</div>   
MESSAGE;
    }
    unset($_SESSION['message']);
}


//показ личного кабинета при существовании $_SESSION['login']
if ($_SESSION['login']) {
    include_once "models/task_list.php";
    include_once "controllers/task_list.php";
    include_once "views/task_list.php";

}
