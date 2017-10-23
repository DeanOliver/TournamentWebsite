<?php
require_once 'dbHandler.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$team = $_POST['team'];
$players = array($_POST['captain'], $_POST['player2'], $_POST['player3'], $_POST['player4'], $_POST['player5']);

$no_players = 5;

if(!$_POST['sub1'] == NULL){
   array_push($players, $_POST['sub1']); 
   $no_players ++; 
}

if(!$_POST['sub2'] == NULL){
   array_push($players, $_POST['sub2']); 
   $no_players ++; 
}

$dupes = has_dupes($players);
if(sizeof($dupes) > 0){
  echo json_encode("Multiple of one user");
  return 0;
}

/* Connect to database */
$db = connect();

/*Check to see if team name is already taken*/
$team_query = "SELECT * FROM teams WHERE name='". $team ."'";
$team_result = query($db, $team_query);

/* Check that team name is not taken*/
if(!($team_result == "Failed Query")){
   if($team_result->name == $team){
      echo json_encode("Team Name Already Taken");
      return 0;
   }
   else{
      echo json_encode("Team Name Already Taken");
      return 0;
   }
}

/* Check to see if players exist*/
for($i=0; $i<$no_players; $i++){
$player_query = "SELECT * FROM users WHERE inGameName='". $players[$i] ."'";
$player_result = query($db, $player_query);

   if($player_result == "Failed Query"){
      echo json_encode("User ". $players[$i] ." does not exist");
      return 0;
   }   
}

/* Take the captains region, for team region*/
$region_query = "SELECT region FROM users WHERE inGameName='". $players[0] ."'";
$region_result = query($db, $region_query);

/* Take the captains platform, for team platform*/
$platform_query = "SELECT platform FROM users WHERE inGameName='". $players[0] ."'";
$platform_result = query($db, $platform_query);

/* Get captains id */
$captain_query = "SELECT user_id FROM users WHERE inGameName='". $players[0] ."'";
$captain_result = query($db, $captain_query);

/* Check to see if players are already in a team*/
for($i=0; $i<$no_players; $i++){
$player_query = "SELECT team_id FROM users WHERE (inGameName='". $players[$i] ."')
                                             AND (platform='" . $platform_result->platform . "')
                                             AND (region='" . $region_result->region . "')";
$player_result = query($db, $player_query);

   if(isset($player_result->team_id)){
      echo json_encode("User ". $players[$i] ." is in a team");
      return 0;
   }   
}

if($region_result == "Failed Query"){
    echo json_encode("No region - Contact admin");
    return 0;
}
else{  
   $insert = "INSERT INTO teams (name, captain, no_players, region, platform)
              VALUES('". $team ."',
                     '". $captain_result->user_id ."', 
                     '". $no_players ."',
                     '". $region_result->region ."',
                     '". $platform_result->platform ."')";
   insert($db, $insert);
   /* Get the new teams id*/
   $team_id_query = "SELECT team_id FROM teams WHERE name='". $team ."'";
   $team_id_result = query($db, $team_id_query);

   /* Update user database with the players new team IDs */
   for($i=0; $i<$no_players; $i++){
      $insert = "UPDATE users SET team_id = '". $team_id_result->team_id ."'
                          WHERE inGameName= '". $players[$i] ."'
                              AND (platform='" . $platform_result->platform . "')
                                AND (region='" . $region_result->region . "')";
      insert($db, $insert);        
    }

    echo json_encode("It Worked");
    return 0;
}

function has_dupes($array){
   return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
}
?>