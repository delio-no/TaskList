<?php

global $db;
try {
    $username = "root";
    $passwd = "root";
    $db = new PDO('mysql:host=localhost;dbname=db_task_list', $username, $passwd);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}

