<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    if(!empty($user_name && !empty($password) && !is_numeric($user_name)))
    {
        $query = "select * from users2 where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
    {
        $user_data = mysqli_fetch_assoc($result);
        if($user_data['password'] === $password)
        {   
            $_SESSION['user_id'] = $user_data['user_id'];
            $_SESSION['email'] = $user_data['email'];
            header("Location: index.php");
            die;
        }
    }
    echo '<span class="error">Incorrect Username or Password.</span>';   
 }
    else
    {
        echo "Incorrect Username or Password";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">
    <link rel="icon" type="image/png" href="SportSelect-logos/SSShort.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportSelect</title>
</head>
<body>
  <div class="header">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="matchpage.php">Matches</a></li>
      <li><a href="http://twitter.com">How To Play</a></li>
      <li><a href="TODO">Refund Policy</a></li>
      <li><a href="RGambling.php">Responsible Gambling</a></li>
      <li><a href="TODO">Support</a></li>
    </ul>
  </div>
  <div class="image">
    <img src ="SportSelect-logos/SportSelect-logos_white2.png" alt="SportSelect">
  </div>
  <form method="post">
  <div class="info">
    <p>Sign in</p>
    <div class="input">
      <h2 class="login">Username:</h2>
      <input type="text" name ="user_name">
      <h2 class="login">Password</h2>
      <input type="password" name ="password">
    </div>
      <button class ="button1">Login</button>

    </div>
</form>
  </div class="text1">
    <h5 class="bottom-text">Dont have an account? <a href="signup.php">Sign up</a></h5>
    <h2 class="bottom-text">Dominate Your FantasySports Games with SportSelect</h2>
  </div>

</body>
</html>
