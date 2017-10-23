<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();

   $platform = $_POST['platform'];
   $region = $_POST['region']; 

   /* Connect to database */
   $db = connect();

   $team_names = array();

   /* Get all specified teams */
   $team_query = "SELECT * FROM teams WHERE platform='" . $platform . "'
   										AND region='" . $region . "'";
   $team_result = mysqli_query($db, $team_query);

   	if (mysqli_num_rows($team_result) > 0) {
	    while($row = mysqli_fetch_assoc($team_result)){
           /* Push the team into an array of teams */
           array_push($team_names, $row["name"]);
	    }	    
	}
	else{
		echo json_encode("No teams");
		return 0;
	}

    /* Sort the teams in alphabetical order */
    sort($team_names);
    echo json_encode($team_names);

?>