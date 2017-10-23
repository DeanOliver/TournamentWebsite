<?php
require_once 'dbHandler.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
session_start(); 

$match_id = $_POST['match_id'];
$team1_name = $_POST['team1_name']; 
$team2_name = $_POST['team2_name']; 
$winner = $_POST['winner']; 
$my_team_id = $_SESSION["team_id"];

/* Connect to database */
$db = connect();

/* Get team1 IDs */
$team1_query = "SELECT team_id FROM teams WHERE name='". $team1_name ."'";
$team1_result = query($db, $team1_query);
/* Check Result */
if($team1_result == "Failed Query"){
   echo json_encode("Team 1 does not exixt");
   return 0;
}

/* Get team2 IDs */
$team2_query = "SELECT team_id FROM teams WHERE name='". $team2_name ."'";
$team2_result = query($db, $team2_query);
/* Check Result */
if($team2_result == "Failed Query"){
    echo json_encode("Team 2 does not exixt");
    return 0;
}
/*Check to see if team name is already taken */
$fixture_query = "SELECT league_id FROM fixtures WHERE (match_id='". $match_id ."')
                                                 AND (team1='". $team1_result->team_id ."')
                                                 AND (team2='". $team2_result->team_id ."')";
$fixture_result = query($db, $fixture_query);
/* Check Result */
if($fixture_result == "Failed Query"){
   echo json_encode("That fixture is not correct");
   return 0;
}

/* Check if submitting team is team1 */
if($my_team_id == $team1_result->team_id){
   /* Input results into the temp table */
   $insert = "UPDATE temp_results SET team1_temp_result = '". $winner ."'
              WHERE match_id= '". $match_id ."'";
   insert($db, $insert);
}
/* Check if submitting team is team2 */
else if($my_team_id == $team2_result->team_id){
   /* Input results into the temp table */
   $insert = "UPDATE temp_results SET team2_temp_result = '". $winner ."'
              WHERE match_id= '". $match_id ."'";
   insert($db, $insert);
}
else{
  echo json_encode("Insert Falied");
  return 0;
}

/* Check to see if both results are submitted */
$results_query = "SELECT * FROM temp_results WHERE match_id='". $match_id ."'";
$results_result = query($db, $results_query);

if((!$results_result->team1_temp_result == 0) && (!$results_result->team2_temp_result == 0)){
   if($results_result->team1_temp_result == $results_result->team2_temp_result){
      $insert = "UPDATE fixtures SET winner = '". $winner ."'
                 WHERE match_id= '". $match_id ."'";
      insert($db, $insert);

      /* Get the winners current league points */
      $points_query = "SELECT points FROM euxboxleague WHERE team_id='". $winner ."'";
      $points_result = query($db, $points_query);

      $new_points = $points_result->points + 3;

      $insert = "UPDATE euxboxleague SET points = '". $new_points ."'
                 WHERE team_id= '". $winner ."'";
      insert($db, $insert);     

   }
}

  echo json_encode("Score Submitted");
  return 0;

?>