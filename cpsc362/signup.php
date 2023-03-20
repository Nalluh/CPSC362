<?php
session_start();

include("connection.php");
include("functions.php");

$userTaken;
$emailTaken;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = trim($_POST['user_name']);
    $password = trim($_POST['password']);
    $email = $_POST['email'];
    if(empty($user_name)){
        echo '<script>window.confirm("Fill in all the correct fields")</script>';


    }
    if(empty($email))
    {
        echo '<script>window.confirm("Fill in all the correct fields")</script>';

    }
   else if(!preg_match('/[a-zA-Z]/', $user_name)){
        //echo '<span class ="error-user-name" id= "info"> User name not valid, please try again</span>';
        echo '<script>window.confirm("User name not valid, please try again")</script>';
    }

    else if (!preg_match('/^[^@]+@[^@]+\.[^@]+$/', $email)) {
       // echo '<span class ="error-user-name" id= "info"> Please enter valid email </span>';
        echo '<script>window.confirm("Please enter valid email")</script>';
    }
$query = "SELECT * FROM users2 WHERE user_name = '$user_name'"; // check if user name is unique
$result2 = mysqli_query($con, $query);
if (mysqli_num_rows($result2) > 0) 
{
    echo '<script>window.confirm("Username taken, please try again")</script>';
    $user_name = '0';
}
$query = "SELECT * FROM users2 WHERE email = '$email'";   // check if email is unique
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) 
{

echo '<script>window.confirm("Email taken, please try again")</script>';

}

 else if(!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($user_name))
    {
        $sanitized_user_name =  mysqli_real_escape_string($con, $user_name);
        $sanitized_password =  mysqli_real_escape_string($con, $password);
        
        $user_points = 1000; 
        $user_id = random_num(20);
        $query = "insert into users2 (user_id,user_name,password,email, Points, totalWinnings) values ('$user_id','$sanitized_user_name','$sanitized_password','$email', '$user_points', '0')";
        mysqli_query($con, $query);
       header("Location: login.php");
        die;
    }
    else
    {
        echo '<span class ="error-user-name" id= "info"> Fill in all the correct fields</span>';
    }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style-sign-up.css">
    <link rel="icon" type="image/png" href="SportSelect-logos/SSShort.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
<div class="image-sign">
    <img src ="SportSelect-logos/SportSelect-logos_white2.png" alt="SportSelect">
  </div>
<form method="post">
    <div class="sign-up">
    <h1>Sign Up!</h1>
    <h2>Username</h2>
    <input type="text" name ="user_name">
    <h2>E-mail</h2>
    <input type="text" name ="email">
    <h2>Password</h2>
    <input type="password" name ="password">
    <button>Sign Up</button>
 
   <h5>Already have an account? <a href="login.php">Login</a></h5>
</div>
</form>
    
</body>
</html>