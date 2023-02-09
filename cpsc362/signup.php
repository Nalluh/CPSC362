<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $query = "SELECT * FROM users2 WHERE user_name = '$user_name'"; // check if user name is unique
    $result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) 
{
    echo '<span class ="error-user-name"id="user_name"> Username is alerady taken</span>';
}
$query = "SELECT * FROM users2 WHERE email = '$email'";   // check if email is unique
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) 
{
echo '<span class ="error-user-name" id="email"> Email is alerady taken</span>';
}

 else if(!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($user_name))
    {
        
        $user_id = random_num(20);
        $query = "insert into users2 (user_id,user_name,password,email) values ('$user_id','$user_name','$password','$email')";
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
    <button>Signup</button>
 
   <h5>Already have an account? <a href="login.php">Login</a></h5>
</div>
</form>
    
</body>
</html>