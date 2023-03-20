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
  <h1><?php echo $user_data['user_name'] ;?></h1>
  <p> <?php echo 'Balance: '. $user_data['Points'];?></p>
</div>
  
<?php
$url_games = "https://api.sportsdata.io/v3/nba/scores/json/GamesByDate/".$date."?key=e480ff73d14d4933a9a4212b69dfca68";
$scores_json_games = file_get_contents($url_games);
$games = json_decode($scores_json_games, true);
$query = "select * from user_info where id = '{$user_data['id']} ORDER BY betPlaced DESC'";
$result = mysqli_query($con, $query);
while ($user_info = mysqli_fetch_assoc($result)) {
    foreach ($games as $game) {
        if ($game['GameID'] == $user_info['gameID']) { // gameID is checked to see if game is active
                 if($game['Status'] == 'InProgress' or $game['Status'] == 'Scheduled')
                 echo $user_info['teambeton'].$user_info['wagerPlaced'];
                 echo "   ".(round((-100/$game['HomeTeamMoneyLine']), 2)); /// !!!!!!!!
                 if($game['HomeTeamMoneyLine'] < 0){
                    echo "hi";
                 }

            }
        }
        if($game['Status']== "Final" or $game['Status'] == "F/OT")
        {
            if($user_info['teambeton'] == $game['AwayTeam']) // entry is awayteam
            {               
                if($game['AwayTeamScore'] > $game['HomeTeamScore'])
                {
                   if($game['AwayTeamMoneyLine']  < 0)
                   {
                    $moneyLine = (-100/$game['AwayTeamMoneyLine']);
                   }
                    //entry won update points and totalWinnings
                   $win = $user_info['wagerPlaced'] ;
                    //$query = "insert into users2(Points, totalWinnings) values ()"
                }
            }
            if($user_info['teambeton'] == $game['HomeTeam'])// entry is awayteam
            {

            }


           // AwayTeamScore

        }
      }


        // api has over displayd with no + while under has - 
      // +150 is equal too 150/100 while -150 is equal too 100/150
?>
    

    