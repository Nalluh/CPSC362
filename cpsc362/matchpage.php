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
 $isEmpty;
 $teams_playing = array();
 $teamNameflag = false;
 $validWager = true;
 $validTeam = true;
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
  $url_games = "https://api.sportsdata.io/v3/nba/scores/json/GamesByDate/2023-MAR-13?key=e480ff73d14d4933a9a4212b69dfca68";
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
        $teams_playing[] = ($game['AwayTeam']);
      }
      if($game['HomeTeam'] == $teams[$i]){
      $home_team_logo = $teams_logos[$i];
      $teams_playing[] = $game['HomeTeam'];
    }
 
  }
  

$games_id = $game["GameID"];
    // SCORES
    $isStarted = false;
    if($game['Status']== "InProgress" or $game['Status']== "Final" or $game['Status'] == "F/OT") // if match started do not allow users to place wager
        {                               // do not display the match on matchpage
          $isStarted = true;
        }
       
        
    if($isStarted ==false){ // if game status is not InProgress Display games

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
    echo "<form method='post' >";
    echo "<span class ='text' >Wager: <input type='text' id = 'submit-bar' name ='Wager_Amount'></span>";
    echo "<span class ='text' >    Team: <input type='text' id = 'submit-bar' name ='Team'></span>";
    echo "<button class ='submit-button'>Submit Wager</button>";
    echo "</form>";
    echo "</div>";
    }
    

    // remove serve request out of for loops causing repititions
  
    
    
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if(!is_numeric($_POST['Wager_Amount']) or empty($_POST['Wager_Amount'])){ // if wager is not a number yell
      echo '<script>alert("Please enter a valid wager amount")</script>';
      $validWager = false;
    } 
    if(empty($_POST['Team']) or is_numeric($_POST['Team'])){ // if team entered is empty or a number yell
        echo '<script>alert("Please select a valid team")</script>';
        $validTeam = false;
    }
    for( $i = 0; $i < count($teams_playing); $i++){
      if($teams_playing[$i] == $_POST['Team']){
      //echo "yes ".$teams_playing[$i];           // if team entered is not apart of todays
      $teamNameflag = true;                     // games or invalid team name throw an error
      }
      if(!$teamNameflag) {
        $teamNameflag = false;
      }
    }
    if(!$teamNameflag)
    {
      echo '<script>alert("Please enter a valid team name")</script>';
      $validTeam = false;

    }
    // if information entered (WAGER/TEAMNAME) is valid continue/initialize
    if(($validTeam) and ($validWager)){
    $wager_amount = $_POST['Wager_Amount'];
    $team = $_POST['Team'];
    echo 'I AM VALID';
    if($wager_amount > $user_data['Points']){ // if wager is greater than points yell
      echo '<script>alert("Insufficient Points")</script>';
    }
    if($wager_amount <= $user_data['Points']){              //if enough points take them and place wager
      $user_points = $user_data['Points']-$wager_amount;    // update DB

      echo "   ".$user_points."    " ;
      $query = "UPDATE users2 SET Points = '$user_points' WHERE user_name = '{$user_data['user_name']}'";
      mysqli_query($con, $query);
      header("Location: matchpage.php");

    }
   

  for( $i = 0; $i < count($teams_playing); $i++){
    echo $i.$teams_playing[$i];
    }
  }
}
?>