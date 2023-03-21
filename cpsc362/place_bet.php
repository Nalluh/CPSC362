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
    <link rel="icon" type="image/png" href="SportSelect-logos/SSShort.png">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Entries</title>
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
  <h1><?php echo $user_data['user_name'] ;?></h1>
  <p> <?php echo 'Balance: '. $user_data['Points'];?></p>
</div>
  
<?php
$url_games = "https://api.sportsdata.io/v3/nba/scores/json/GamesByDate/".$date."?key=e480ff73d14d4933a9a4212b69dfca68";
$scores_json_games = file_get_contents($url_games);
$games = json_decode($scores_json_games, true);
$query = "select * from user_info where id = '{$user_data['id']} ORDER BY betPlaced DESC'";
$result = mysqli_query($con, $query);
$winnerwinner = false;

while ($user_info = mysqli_fetch_assoc($result)) {
    foreach ($games as $game) {
        if ($game['GameID'] == $user_info['gameID']) { // gameID is checked to see if game is active
                 if($game['Status'] == 'InProgress' or $game['Status'] == 'Scheduled')
                // echo "1: ".$user_info['teambeton'].$user_info['wagerPlaced']. "\n";
                 //echo $game['AwayTeamMoneyLine']."   ".(round((-100/$game['AwayTeamMoneyLine']), 2)); /// !!!!!!!!
                 //if($game['AwayTeamMoneyLine'] < 0){
                    //echo "hi";
                // }
                $query= "select * from user_info where result IS NULL and gameID ={$user_info['gameID']}";
                 if($game['Status']== "Final" or $game['Status'] == "F/OT")
                 {
                     if($user_info['teambeton'] == $game['AwayTeam']) // entry is awayteam
                     {
                         if($game['AwayTeamScore'] > $game['HomeTeamScore']) // good wager 
                         {
                           $winnerwinner = true;
                            if($game['AwayTeamMoneyLine']  < 0) //-150 is equal too 100/150  // overdog
                            {
                             $moneyLine = (round((-100/$game['AwayTeamMoneyLine']), 2));
                            }
                            else{
                             $moneyLine = (round(($game['AwayTeamMoneyLine']/100),2));// +150 is equal too 150/100  /// underdog 
                             }
                             //entry won update points and totalWinnings
                             
                            $win = $user_info['wagerPlaced'] + ($user_info['wagerPlaced'] * $moneyLine);
                            $updatedPoints = $win +  $user_data['Points'];
                            $totalwin = $user_data['totalWinnings'] + $win;
                            $query= "select * from user_info where result IS NULL and gameID ={$user_info['gameID']}";
                            
                            $result2 = mysqli_query($con, $query);
                            echo mysqli_num_rows($result2);
                            if(mysqli_num_rows($result2) > 0){ // look at db see if result is null if not null continue
                             $query = "update users2 set Points = '$updatedPoints' , totalWinnings = '$totalwin'  where id = '{$user_data['id']}'";
                             mysqli_query($con, $query);
                             $query = "update user_info set result = '$winnerwinner', amountWon = '$win' where gameID = '{$user_info['gameID']}'";
                             mysqli_query($con, $query);
                             $win = 0;
                             $totalwin = 0;
                             $updatedPoints =0;
                            }
                             
                         }
                         else{ // bad wager
                           $winnerwinner = false;
                           $query = "update user_info set result = '$winnerwinner', amountWon = 0 where gameID = '{$user_info['gameID']}'";
                           mysqli_query($con, $query);
                         }
                     }
                     if($user_info['teambeton'] == $game['HomeTeam'])// entry is home team
                     {
                       if($game['HomeTeamScore'] > $game['AwayTeamScore']) // good wager 
                         {
                            $winnerwinner = true;
                            if($game['HomeTeamMoneyLine']  < 0) //-150 is equal too 100/150  // overdog
                            {
                             $moneyLine = (round((-100/$game['HomeTeamMoneyLine']), 2));
                            }
                            else{
                             $moneyLine = (round(($game['HomeTeamMoneyLine']/100),2));// +150 is equal too 150/100  /// underdog 
                             }
                             //entry won update points and totalWinnings
                             $win = $user_info['wagerPlaced'] + ($user_info['wagerPlaced'] * $moneyLine);
                             $updatedPoints = $win +  $user_data['Points'];
                            $totalwin = $user_data['totalWinnings'] + $win;
                            $query= "select * from user_info where result IS NULL and gameID ={$user_info['gameID']}";
                            $result2 = mysqli_query($con, $query);
                            if(mysqli_num_rows($result2) > 0){ // look at db see if result is null if not null continue
                             $query = "update users2 set Points = '$updatedPoints' , totalWinnings = '$totalwin'  where id = '{$user_data['id']}'";
                             mysqli_query($con, $query);
                             $query = "update user_info set result = '$winnerwinner', amountWon = '$win' where gameID = '{$user_info['gameID']}'";
                             mysqli_query($con, $query);
                             $win = 0;
                             $totalwin = 0;
                             $updatedPoints =0;
                            }
                             
         
                         }
                         else{ // bad wager
                           $winnerwinner = false;
                           $query = "update user_info set result = '$winnerwinner', amountWon = 0 where gameID = '{$user_info['gameID']}'";
                           mysqli_query($con, $query);
                         }
                     }
                 } 
            }
        }
      }


        // api has over displayd with no + while under has - 

?>
    

    