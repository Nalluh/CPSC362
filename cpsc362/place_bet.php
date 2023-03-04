<?php
// Replace with your own API key
$api_key = "e480ff73d14d4933a9a4212b69dfca68";

// Get the form data
$game_id = $_POST['game_id'];
$wager_amount = $_POST['wager_amount'];
$bet_on_home_team = isset($_POST['bet_on_home_team']) && $_POST['bet_on_home_team'] == 1;

// Make a request to get the current odds for the game
$response = file_get_contents("https://api.sportsdata.io/v3/nba/odds/json/BettingMarketsByGameID/{$game_id}?key={$api_key}");
$odds = json_decode($response, true);

// Determine which team to bet on based on the user's input
$team_to_bet_on = $bet_on_home_team ? "HomeTeam" : "AwayTeam";
$odds_for_team_to_bet_on = $odds["{$team_to_bet_on}Odds"]['MoneyLine'];

// Place the bet
$response = file_get_contents("https://api.sportsdata.io/v3/nba/odds/json/PostGameOddBet?gameid={$game_id}&amount={$wager_amount}&moneyline={$odds_for_team_to_bet_on}&key={$api_key}");
$bet = json_decode($response, true);

// Check if the bet was successful
if ($bet["BetStatus"] == "Accepted") {
    echo "Bet placed successfully!";
} else {
    echo "Error placing bet: " . $bet["BetStatus"];
}
?>
