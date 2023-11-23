<?php

require_once('./config/database.php');

function query_select(String $query)
{

    global $database;

    $sql = mysqli_query($database, $query);
    $result = mysqli_fetch_assoc($sql);

    return $result;
}

function query_action(String $query)
{
    global $database;

    $sql = mysqli_query($database, $query);

    return $sql;
}
