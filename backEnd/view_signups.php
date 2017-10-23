<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();    

    $league = $_POST['league'];

    /* Connect to database */
    $db = connect();
    /* Get the players of the users team */
    $signup_query = "SELECT * FROM " . $league;
    $signup_result = mysqli_query($db, $signup_query);

    /*Create an array for the roster to go in*/
    $team_data = array();

	  if (mysqli_num_rows($signup_result) > 0) {
	     while($row = mysqli_fetch_assoc($signup_result)) {

          $team_name_query = "SELECT name FROM teams WHERE team_id='" . $row["team_id"] . "'";
          $team_name_result = query($db, $team_name_query);
          /* Push the teams into an array */
          array_push($team_data, array('team_name' => $team_name_result->name));
	     }
	  }
    else{
       echo json_encode("No Signups");
       return 0;
    }

   echo json_encode($team_data);
?>