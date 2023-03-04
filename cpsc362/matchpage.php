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

<link rel = "stylesheet" href ="style-match.css">
<link rel="stylesheet" href="header.css">
<link rel="icon" type="image/png" href="SportSelect-logos/SSShort.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchPage</title>
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
<a id ="logout" href= "logout.php"> Logout </a>
  
 <div class ="username-place" >
  <h1> <?php echo $user_data['user_name'];?></h1>
  <p> <?php echo 'Balance: '. $user_data['Points'];?></p>
</div> 
</body>
</html>
<?php
 $pointsDis = false;
 $warned = false;
$teams = array(
    "ATL", "BOS", "BKN","CHA", "CHI", "CLE","DAL","DEN","DET","GS", "HOU", "IND", "LAC", "LAL", "MEM", "MIA","MIL", "MIN", "NO", "NY",
    "OKC", "ORL","PHI", "PHX", "POR", "SAC", 'SA',"TOR","UTA", "WAS"
  );
  $teams_logos = array(
    'NBA LOGOS\hawks.png','NBA LOGOS\celtics.png','NBA LOGOS\nets.png', 'NBA LOGOS\hornets.png','NBA LOGOS\bulls.png', 'NBA LOGOS\cavaliers.png', 'NBA LOGOS\mavericks.png', 'NBA LOGOS\nuggets.png', 'NBA LOGOS\pistons.png',
    'NBA LOGOS\golden-state-warriors.png', 'NBA LOGOS\rockets.png','NBA LOGOS\pacers.png','NBA LOGOS\clippers.png','NBA LOGOS\lakers.png','NBA LOGOS\grizzlies.png','NBA LOGOS\heat.png', 'NBA LOGOS\bucks.png','NBA LOGOS\timberwolves.png',
   'NBA LOGOS\pelicans.png', 'NBA LOGOS\knicks.png','NBA LOGOS\thunder.png','NBA LOGOS\magic.png','NBA LOGOS\76ers.png','NBA LOGOS\suns.png','NBA LOGOS\trail-blazers.png','NBA LOGOS\kings.png',
  'NBA LOGOS\spurs.png','NBA LOGOS\raptors.png','NBA LOGOS\jazz.png','NBA LOGOS\wizards.png'
  );
  $url_games = "https://api.sportsdata.io/v3/nba/scores/json/GamesByDate/2023-MAR-4?key=e480ff73d14d4933a9a4212b69dfca68";
  $scores_json_games = file_get_contents($url_games);
  $games = json_decode($scores_json_games, true);
  
  $dateofgame = $games[0];
  $date = substr($dateofgame['DateTime'], 0,10 );
  echo "<h1> NBA Games $date </h1>";
  
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
  

$games_id = $game["GameID"];
    // SCORES
    echo "<div class='game'>";
  
  
    echo "<img src= '$away_team_logo' alt='{$game['AwayTeam']}'>" .   "<br> <br> <br> <br>" . "<span class='team-name'>{$game['AwayTeam']}</span>";
    echo "<br> <br> <br> <br>";
    echo "<span class='score'>{$game['AwayTeamScore']}</span>";
    echo "<span class='at-symbol'> @</span>";
    echo "<span class='score'>{$game['HomeTeamScore']}</span>";
    echo "<span class='team-name'>{$game['HomeTeam']}</span>";
    echo "<br> <br> <br> <br>";
    echo "<img src='$home_team_logo' alt='{$game['HomeTeam']}'>";
    echo "<br>  ";
    echo "</div>";
    echo "<div class= 'submit-bar'>";
    echo "<form method='post'>";
    echo "<span class ='text' >Wager: <input type='text' id = 'submit-bar' name ='Wager_Amount'></span>";
    echo "<span class ='text' >    Team: <input type='text' id = 'submit-bar' name ='Team'></span>";
    echo "<button class ='submit-button'>Submit Wager</button>";
    echo "</form>";
    echo "</div>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      
      if(($user_data['Points'] <= 'Wager_Amount') && ($warned == false))
      { 
        echo '<script>alert("Not enough in balance")</script>';
        $warned = true;

      }
      if('Team' == ""||'Wager_Amount' == "")
      {
      }
      else{
      $team = $_POST["Team"];
      $wager = $_POST["Wager_Amount"];
      $user_points = $user_data['Points'];
      for($j =0; $j < count($teams); $j++){
      if($team == $teams[$j] ) 
    {
      // if name is correct wager = $wager and insert into points $wager - points
      if($user_points <0){
        echo  '<script>alert("Not enough in balance")</script>';      
      }
      if($pointsDis = true){
        $user_points -= $wager;
        $query = "UPDATE users2 SET Points = $user_points WHERE user_name = '{$user_data['user_name']}'";
        mysqli_query($con, $query);
        $j=30;
      } 
    } // place wager
    
  }
}
}
 }
  
    
?>