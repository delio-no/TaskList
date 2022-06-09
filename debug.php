<?php

function stmtFailed($stmt, $request, $nameFailed)
{
    if (!$stmt->execute(array($request))) {
        $stmt = null;
        header("location: ../task_list.php?error={$nameFailed}");
        exit();
    }
}