<?php

session_start();


//показ регистрации кабинета, если не существует существовании $_SESSION['login']
if (empty($_SESSION['login'])) {
    include_once "views/signup.php";
}


//показ личного кабинета при существовании $_SESSION['login']
if ($_SESSION['login']) {
    header("location: ../login.php");
    exit;
}

