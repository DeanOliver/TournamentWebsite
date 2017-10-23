<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();    

    /* Connect to database */
    $db = connect();
    /* Get the players of the users team */
    $my_roster_query = "SELECT * FROM users WHERE team_id='" . $_SESSION["team_id"] . "'";
    $my_roster_result = mysqli_query($db, $my_roster_query);

    /*Create an array for the roster to go in*/
    $team_data = array();

	  if (mysqli_num_rows($my_roster_result) > 0) {
	     while($row = mysqli_fetch_assoc($my_roster_result)) {
          /* Push the team members into an array of teams */
          array_push($team_data, array('inGameName' => $row["inGameName"]));
	     }
	  }
    else{
       echo json_encode("No roster");
       return 0;
    }

   echo json_encode($team_data);
?>