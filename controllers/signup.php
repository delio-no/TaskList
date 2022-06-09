<?php

session_start();

include "../models/signup.php";

$login = $_POST['login'];
$password = $_POST['password'];
$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$passwordVerify = password_verify($password, getPassword($login));
$_SESSION['message'] = [];

//валидация на пустые поля
if ($login == '' || $password == '') {
    unset($_SESSION['login']);
    $_SESSION['message'][] = 'Заполните пустые поля';
    header("location: ../index.php");
    exit;
}

//валидация на существующий логин/неправильный пароль
if ($login == getLogin($login) && !$passwordVerify) {
    unset($_SESSION['login']);
    $_SESSION['message'][] = 'Такой логин уже существует';
    header("location: ../index.php");
    exit;
}

//авторизация
if ($login == getLogin($login) && $passwordVerify) {
    $_SESSION['id_user'] = getUserId($login);
    $_SESSION['login'] = $login;
    header("location: ../index.php");
    exit;
}

//создание пользователя
if (!($login == getLogin($login)) && !$passwordVerify) {
    $_SESSION['id_user'] = getUserId($login);
    $_SESSION['login'] = $login;
    createUser($login, $passwordHash);
    header("location: ../index.php");
    exit;
}












