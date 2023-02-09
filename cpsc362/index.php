<?php
session_start();
   
include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportSelect</title>
</head>
<body>
<div class="header">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="http://twitter.com">How To Play</a></li>
      <li><a href="TODO">Refund Policy</a></li>
      <li><a href="TODO">Responsible Gambling</a></li>
      <li><a href="TODO">Support</a></li>
    </ul>
  </div>
  <a href= "logout.php"> Logout</a>
  <h1>This is home</h1>
  Hello, <?php echo $user_data['user_name'],$user_data['email'] ;?>
</body>
</html>