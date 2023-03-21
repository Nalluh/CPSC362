<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index-page.css">

<link rel = "stylesheet" href ="style-match.css">
<link rel="stylesheet" href="header.css">
<link rel="icon" type="image/png" href="SportSelect-logos/SSShort.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Wager History</title>
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
</body>
</html>
<?php
$teams = array(
    "ATL", "BOS", "BKN","CHA", "CHI", "CLE","DAL","DEN","DET","GS", "HOU", "IND", "LAC", "LAL", "MEM", "MIA","MIL", "MIN", "NO", "NY",
    "OKC", "ORL","PHI", "PHO", "POR", "SAC", 'SA',"TOR","UTA", "WAS"
  );
 
$dateREF ="";
$url_games = "https://api.sportsdata.io/v3/nba/scores/json/GamesByDate/".$date."?key=e480ff73d14d4933a9a4212b69dfca68";
$scores_json_games = file_get_contents($url_games);
$games = json_decode($scores_json_games, true);
echo "<h1> Transaction Log</h1>";
echo "<div class='hContainer'>";

// get data 
$query = "select * from user_info where id = '{$user_data['id']}' ORDER BY gameID DESC";

$result = mysqli_query($con, $query);
echo "<div class='hHeader'>";
echo "<span class='number2'>Date</span>";
echo "<span class='number2'>Wager</span>";
echo "<span class='number2'>Team</span>";         // cant change variable name breaks program????
echo "<span class='number2'>Result</span>";
echo "<span class='number2'>Payout</span>";
echo "</div>";

while ($user_info = mysqli_fetch_assoc($result)) {
  
    
    if($dateREF != $user_info['betPlaced']){ 
    $dateREF = $user_info['betPlaced'];
    }
    if($dateREF == $user_info['betPlaced'])
    {
     
        echo "<div class='history'>";
        echo"<div>";
        echo "<span class='number' id ='hhDate'>{$user_info['betPlaced']}</span>";
        echo "<span class='number'id ='hhAmount'>{$user_info['wagerPlaced']}</span>";//cant change variable name breaks program????
        echo "<span class='number'id ='hhTeam'>{$user_info['teambeton']}</span>";
        if(!is_null($user_info['result'])){ // if entry in db is not null show it
        if($user_info['result'] == 1){
        echo "<span class='number'id ='hhResultWon'>Won!</span>";
        }
        else if($user_info['result'] == 0 ){
          echo "<span class='number'id ='hhResultLoss'>Loss!</span>";
        }
      }
        else{ // else its null print empty value
          echo "<span class='number'>{$user_info['result']}</span>";
        }
        echo "<span class='number'id ='hhWon'>{$user_info['amountWon']}</span>";
        echo "</div>";
        echo "</div>";
    }
}

echo "</div>";
?>