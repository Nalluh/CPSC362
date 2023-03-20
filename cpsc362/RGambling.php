<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="index-page.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="Style-RGambling.css">

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
      <li><a href="place_bet.php">Entries</a></li>
      <li><a href="userHistory.php">Wager History</a></li>
      <li><a href="RGambling.php">Responsible Gambling</a></li>
      <li><a href="TODO">Support</a></li>
    </ul>
  </div>
  
   <a id ="logout" href= "logout.php"> Logout </a>
  
  <div class ="username-place" >
  <h1> <?php echo $user_data['user_name'] ;?></h1>
  <p> <?php echo 'Balance: '. $user_data['Points'];?></p>
</div>

<h2> Responsible Gambling </h2>
  
<div class = "container">
  <p>-Responsible gambling is a practice that involves ensuring that gambling is conducted in a way that is safe, fair, and enjoyable for all participants. This means taking steps to minimize the risks associated with gambling, such as setting limits on the amount of time and money spent, and being aware of the potential negative consequences of gambling. It also involves making sure that gambling is conducted in a way that is fair and transparent, with clear rules and regulations that are enforced consistently.</p>
  <br>
<p>-Responsible gambling is important because it helps to protect individuals from the potential harms of gambling, such as addiction, financial difficulties, and relationship problems. By taking steps to gamble responsibly, individuals can ensure that they are enjoying the activity in a way that is safe and sustainable over the long term. Additionally, responsible gambling helps to promote a positive image of the gambling industry, by demonstrating that operators are committed to protecting the interests of their customers and promoting a safe and enjoyable gambling experience for all.</p>
<br>
<p>-There are many ways in which individuals can practice responsible gambling. Some of the most important include setting limits on the amount of time and money spent, being aware of the signs of problem gambling and seeking help when necessary, and avoiding gambling when under the influence of drugs or alcohol. By adopting these practices, individuals can ensure that they are able to enjoy gambling in a way that is safe, sustainable, and enjoyable over the long term. Ultimately, responsible gambling is about taking a balanced and informed approach to the activity, and recognizing that it can be a fun and entertaining pastime when conducted in a responsible and sustainable manner.</p>

<p>-For individuals struggling with gambling addiction, there are many resources available, including hotlines, support groups, and counseling services, that provide confidential and non-judgmental support to help them overcome their addiction.</p>  <br> <p>-National Council on Problem Gambling: call the helpline at <strong>1-800-522-4700</strong> or visit their website at <a href="https://www.ncpgambling.org/help-treatment/national-helpline-1-800-522-4700/">https://www.ncpgambling.org/help-treatment/national-helpline-1-800-522-4700/</a>
<br><br>-Gamblers Anonymous: visit their website at <a href="https://www.gamblersanonymous.org/ga/hotlines">https://www.gamblersanonymous.org/ga/hotlines </a>to find a hotline in your area
Gambling Therapy: visit their website at <a href="https://www.gamblingtherapy.org/">https://www.gamblingtherapy.org/ </a>to access their online support services and resources
In addition to these organizations, many local health clinics and community organizations may also offer support for gambling addiction. It's important to reach out for help if you or someone you know is struggling with gambling addiction.</p>
</div>