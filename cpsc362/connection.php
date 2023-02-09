<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sslogin";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed1 to conect");
}
?>