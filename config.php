<?php
session_start();
session_regenerate_id(true);

// LOAD ENVIRONMENT VARIABLES FROM .env FILE
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($name, $value) = explode('=', $line, 2);
        putenv(sprintf('%s=%s', $name, $value));
    }
}

// SET DATABASE CONNECTION PARAMETERS
$db_host = getenv('DB_HOST');
$db_username = getenv('DB_USERNAME');
$db_password = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');

// $db_connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

$db_connection = mysqli_connect("localhost:3306","root","","restaurant_review");

// CHECK DATABASE CONNECTION
if (mysqli_connect_errno()) {
    echo "Connection Failed".mysqli_connect_error();
    exit;
}
?>