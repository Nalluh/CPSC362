<?php
session_start();

if(isset ($_SESSION['user_id']))
{
    unset($_SESSION['user_id']);
}

header("location: login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="SportSelect-logos/SSShort.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportSelect</title>
</head>
<body>
    
</body>
</html>