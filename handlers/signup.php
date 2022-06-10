<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . "/config_db.php");

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


//Если логин существует пишем ошибку, иначе регистрируем\авторизируем пользователя
if ($login == getLogin($login)) {
    if (!$passwordVerify) {
        unset($_SESSION['login']);
        $_SESSION['message'][] = 'Такой логин уже существует';
        header("location: ../index.php");
        exit;
    }
    if ($passwordVerify) {
        $_SESSION['id_user'] = getUserId($login);
        $_SESSION['login'] = $login;
        header("location: ../index.php");
        exit;
    }
} else {
    $_SESSION['id_user'] = getUserId($login);
    $_SESSION['login'] = $login;
    createUser($login, $passwordHash);
    header("location: ../login.php");
    exit;
}

//выборка логина
function getLogin($login)
{
    $stmt = $GLOBALS['db']->prepare("SELECT login FROM user WHERE login = (?)");
    if (!$stmt->execute(array($login))) {
        $stmt = null;
        header("location: ../task_list.php?error=getLogin");
        exit;
    }
    return $stmt->fetchColumn();
}

//создание пользователя
function createUser($login, $password)
{
    $stmt = $GLOBALS['db']->prepare("INSERT INTO user (login, password, created_at) VALUES (?, ?, NOW())");
    if (!$stmt->execute(array($login, $password))) {
        $stmt = null;
        header("location: ../task_list.php?error=stmtfailed");
        exit;
    }
    $stmt = null;
}

//выборка пароля
function getPassword($login)
{
    $stmt = $GLOBALS['db']->prepare("SELECT password FROM user WHERE login = (?)");
    if (!$stmt->execute(array($login))) {
        $stmt = null;
        header("location: ../task_list.php?error=getLogin");
        exit;
    }
    return $stmt->fetchColumn();
}


//выборка id пользователя
function getUserId($login)
{
    $stmt = $GLOBALS['db']->prepare("SELECT user_id FROM user WHERE login = (?)");
    if (!$stmt->execute(array($login))) {
        $stmt = null;
        header("location: ../task_list.php?error=getLogin");
        exit;
    }
    return $stmt->fetchColumn();
}


















