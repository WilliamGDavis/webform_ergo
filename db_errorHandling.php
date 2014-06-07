<?php

function db_errorHandler($errno, $errstr, $errfile, $errline) {
    include '../scripts/mysql_login_pdo.php';
    $query = "INSERT INTO `error_log` "
            . "VALUES(:id,:error_time,:errno,:errstr,:errfile,:errline)";
    $stmt = $db->prepare($query);
    $stmt->execute(array(
        ':id' => null,
        ':error_time' => null,
        ':errno' => $errno,
        ':errstr' => $errstr,
        ':errfile' => $errfile,
        ':errline' => $errline
    ));
    return true; //Don't execute PHP error handler
}
