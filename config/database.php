<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'phptts';

$database = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Connection Faild. Please Check Your Database Configuration. :)');
