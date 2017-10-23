<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();

   /* Connect to database */
   $db = connect();

   $team_id = $_SESSION['team_id'];
   $league = $_POST['league'];

   /* check if team is already in the league */
   $team_query = "SELECT team_id FROM ".$league." WHERE team_id='". $team_id ."'";
   $team_result = query($db, $team_query);

   if(!($team_result == "Failed Query")){      
       echo json_encode("You're already in this league");
       return 0;
   }

   $insert = "INSERT INTO ".$league." (team_id, points)
              VALUES('". $team_id ."', ' 0 ')";
   insert($db, $insert);

   echo json_encode("It Worked");
?>