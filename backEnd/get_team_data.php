<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();

   $team_name = $_POST['team_name'];

   /* Connect to database */
   $db = connect();

   $team_data = array();    // Holds all returned data on the team
   $team_roster = array();  // Holds the team roster
   $fixture_data = array(); // Holds the teams fixtures

   /* Get all specified teams */
   $team_id_query = "SELECT * FROM teams WHERE name='" . $team_name . "'";
   $team_id_result = query($db, $team_id_query);

   $team_id = $team_id_result->team_id;

   /* Get the players of the selected team */
   $roster_query = "SELECT * FROM users WHERE team_id='" . $team_id . "'";
   $roster_result = mysqli_query($db, $roster_query);

   if (mysqli_num_rows($roster_result) > 0) {
      while($row = mysqli_fetch_assoc($roster_result)) {
         /* Push the team members into an array of teams */
         array_push($team_roster, $row["inGameName"]);
      }
   }

   /* Get the fixture for the selected team */
   $team_fixture_query = "SELECT * FROM fixtures WHERE ((team1='" . $team_id . "')
                                                    OR (team2='" . $team_id . "'))
                                                   AND (winner!='0')";
   $team_fixture_result = mysqli_query($db, $team_fixture_query);

   if (mysqli_num_rows($team_fixture_result) > 0) {
       while($row = mysqli_fetch_assoc($team_fixture_result)) {
          /* Find the team1 names */
          $team1_query = "SELECT name FROM teams WHERE team_id='" . $row["team1"] . "'";
          $team1_result = query($db, $team1_query);

          /* Find the team2 names */
          $team2_query = "SELECT name FROM teams WHERE team_id='" . $row["team2"] . "'";
          $team2_result = query($db, $team2_query);

          /* If selected team is the winner */
          if($row["winner"] == $team_id){
             $row["winner"] = "WON";
          } 
          /* If selected team is not the winner */
          elseif((!($row["winner"] == $team_id)) && (!($row["winner"] == 0))){
             $row["winner"] = "LOST";
          }
          /* Push the team into an array of teams */
          array_push($fixture_data, array($row["league_id"] , $team1_result->name ,
                                          $team2_result->name , $row["winner"]));
       }
   }
   else{
      array_push($fixture_data, array("No Fixtures"));
   }

   $fixture_data = array_reverse($fixture_data);
   array_push($team_data, $team_roster);
   array_push($team_data, $fixture_data);


   echo json_encode($team_data);
?>