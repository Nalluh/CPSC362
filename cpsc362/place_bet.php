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
    <link rel="stylesheet" href="style-match.css">
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
$counter =0;
$teams = array(
    "ATL", "BOS", "BKN","CHA", "CHI", "CLE","DAL","DEN","DET","GS", "HOU", "IND", "LAC", "LAL", "MEM", "MIA","MIL", "MIN", "NO", "NY",
    "OKC", "ORL","PHI", "PHO", "POR", "SAC", 'SA',"TOR","UTA", "WAS"
  );
  $teams_logos = array(
    'NBA LOGOS\hawks.png','NBA LOGOS\celtics.png','NBA LOGOS\nets.png', 'NBA LOGOS\hornets.png','NBA LOGOS\bulls.png', 'NBA LOGOS\cavaliers.png', 'NBA LOGOS\mavericks.png', 'NBA LOGOS\nuggets.png', 'NBA LOGOS\pistons.png',
    'NBA LOGOS\golden-state-warriors.png', 'NBA LOGOS\rockets.png','NBA LOGOS\pacers.png','NBA LOGOS\clippers.png','NBA LOGOS\lakers.png','NBA LOGOS\grizzlies.png','NBA LOGOS\heat.png', 'NBA LOGOS\bucks.png','NBA LOGOS\timberwolves.png',
   'NBA LOGOS\pelicans.png', 'NBA LOGOS\knicks.png','NBA LOGOS\thunder.png','NBA LOGOS\magic.png','NBA LOGOS\76ers.png','NBA LOGOS\suns.png','NBA LOGOS\trail-blazers.png','NBA LOGOS\kings.png',
  'NBA LOGOS\spurs.png','NBA LOGOS\raptors.png','NBA LOGOS\jazz.png','NBA LOGOS\wizards.png'
  );
$url_games = "https://api.sportsdata.io/v3/nba/scores/json/GamesByDate/".$date."?key=e480ff73d14d4933a9a4212b69dfca68";
$scores_json_games = file_get_contents($url_games);
$games = json_decode($scores_json_games, true);
$query = "select * from user_info where id = '{$user_data['id']} ORDER BY betPlaced DESC'";
$result = mysqli_query($con, $query);
$query2 = "select * from user_info where id = '{$user_data['id']}' and result = 1";
$results = mysqli_query($con, $query2);
$counter = mysqli_num_rows($results);
echo "<div class = 'entryContainer'>";
echo "<div class = 'right'>";
echo "<div class = 'namePlace'>";
echo "Career Winnings: ".$user_data['totalWinnings']."<br>";
echo "Entry Wins: ".$counter;
echo   "</div>";
echo   "</div>";
echo "<div class = 'left'>";

foreach($games as $game){
   
    for ($i = 0; $i < count($teams); $i++) 
       {
        
      if($game['AwayTeam'] == $teams[$i]){
      $away_team_logo = $teams_logos[$i];
      }
      if($game['HomeTeam'] == $teams[$i]){
      $home_team_logo = $teams_logos[$i];
    }
 
  }
} 
while ($user_info = mysqli_fetch_assoc($result)) {
    foreach ($games as $game) {
        for ($i = 0; $i < count($teams); $i++) 
       {
        
      if($user_info['teambeton'] == $teams[$i]){
      $team_logo = $teams_logos[$i];
      break;
      }
  }
  if(empty($user_info['gameID'])){
    echo "HELp";
  }
        if ($game['GameID'] == $user_info['gameID']) { // gameID is checked to see if game is active
                 if($game['Status'] == 'InProgress' or $game['Status'] == 'Scheduled'){
                    if($user_info['teambeton'] == $game['AwayTeam']) // entry is awayteam
                     {
                        if($game['AwayTeamMoneyLine']  < 0) //-150 is equal too 100/150  // overdog
                            {
                             $payout = $user_info['wagerPlaced']+($user_info['wagerPlaced']*(round((-100/$game['AwayTeamMoneyLine']), 2)));
                            }
                            else{
                             $payout = $user_info['wagerPlaced']+($user_info['wagerPlaced']*(round(($game['AwayTeamMoneyLine']/100),2)));// +150 is equal too 150/100  /// underdog 
                             }
                     }
                  if($user_info['teambeton'] == $game['HomeTeam']) // entry is awayteam
                     {
                        if($game['HomeTeamMoneyLine']  < 0) //-150 is equal too 100/150  // overdog
                            {
                             $payout = $user_info['wagerPlaced']+($user_info['wagerPlaced']*(round((-100/$game['HomeTeamMoneyLine']), 2)));
                            }
                            else{
                             $payout = $user_info['wagerPlaced']+($user_info['wagerPlaced']*(round(($game['HomeTeamMoneyLine']/100),2)));// +150 is equal too 150/100  /// underdog 
                             }
                     }
                     //

                    echo "<div class = entryGames>";
                    
                    echo "<img id ='entryIMG' src ='$team_logo' alt = {$user_info['teambeton']}><br>";
                    echo $user_info['wagerPlaced']." points wagered on ".$user_info['teambeton']."<br>";
                    echo "Possible Payout: ".$payout;
                    echo $game['Quarter']."<br>";
                    echo "</div>";
                 /// ^^ if statement must show the games that are currently inprogress or scheduled
                // but it should not be involved in the entire process 
                
                 }
                 if($game['Status']== "Final" or $game['Status'] == "F/OT")
                 {
                     if($user_info['teambeton'] == $game['AwayTeam']) // entry is awayteam
                     {
                         if($game['AwayTeamScore'] > $game['HomeTeamScore']) // good wager 
                         {
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
                            if(mysqli_num_rows($result2) > 0){ // look at db see if result is null if not null continue
                             $query1st = "update users2 set Points = '$updatedPoints' , totalWinnings = '$totalwin'  where id = '{$user_data['id']}'";
                             mysqli_query($con, $query1st);
                             $query = "update user_info set result = true, amountWon = '$win' where gameID = '{$user_info['gameID']}'";
                             mysqli_query($con, $query);
                        
                            }
                             
                         }
                         else{ // bad wager
                           $query = "update user_info set result = false, amountWon = 0 where gameID = '{$user_info['gameID']}'";
                           mysqli_query($con, $query);
                         }
                     }
                     if($user_info['teambeton'] == $game['HomeTeam'])// entry is home team
                     {
                       if($game['HomeTeamScore'] > $game['AwayTeamScore']) // good wager 
                         {

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
                             $query1st = "update users2 set Points = '$updatedPoints' , totalWinnings = '$totalwin'  where id = '{$user_data['id']}'";
                             
                             mysqli_query($con, $query1st);
                             $query2nd = "update user_info set result = true, amountWon = '$win' where gameID = '{$user_info['gameID']}'";
                             mysqli_query($con, $query2nd);
                             
                            }
                             
         
                         }
                         else{ // bad wager
                           $query = "update user_info set result = false , amountWon = 0 where gameID = '{$user_info['gameID']}'";
                           mysqli_query($con, $query);
                         }
                     }
                 } 
            }
        }
      }
      echo   "</div>";

      echo   "</div>";

        // api has over displayd with no + while under has - 
   
?>
    

    