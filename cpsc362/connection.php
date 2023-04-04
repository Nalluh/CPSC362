<?php
date_default_timezone_set('America/Los_Angeles');
$date =  date('Y-m-d');
//$date = "2023-APR-02";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sslogin";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed1 to conect");
}
?>