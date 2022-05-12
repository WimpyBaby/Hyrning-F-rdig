<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "uthyrning";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die("Failed to connect");
}
?>