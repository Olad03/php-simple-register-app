<?php
$con = mysqli_connect("localhost", "root", "mysqldb", "register");

// Initiate DB connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
