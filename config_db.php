<?php

function connect()
{
    try {
        $username = "root";
        $password = "root";
        $db = new PDO('mysql:host=localhost;dbname=db_task_list', $username, $password);
        return $db;
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
