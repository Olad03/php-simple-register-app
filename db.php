<?php
$con = mysqli_connect("mysql", "mysqldb", "mysqldb", "register");

// Initiate DB connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = new mysqli("mysql", "mysqldb", "mysqldb", "register");
$con->set_charset("utf8mb4");

if ($con->connect_error) {
    die("Database connection failed");
     f51407a (Initial commit - PHP Simple Register App v2.0)
}
