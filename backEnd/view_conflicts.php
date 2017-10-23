<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();    

    /* Connect to database */
    $db = connect();
    /* Get the players of the users team */
    $conflict_query = "SELECT * FROM temp_results WHERE (team1_temp_result!='0'
                                                  AND  team2_temp_result!='0')
                                                  AND (team1_temp_result!=team2_temp_result)";
    $conflict_result = mysqli_query($db, $conflict_query);

    /*Create an array for the roster to go in*/
    $team_data = array();

	  if (mysqli_num_rows($conflict_result) > 0) {
	     while($row = mysqli_fetch_assoc($conflict_result)) {

          $team1_name_query = "SELECT name FROM teams WHERE team_id='" . $row["team1_id"] . "'";
          $team1_name_result = query($db, $team1_name_query);

          $team2_name_query = "SELECT name FROM teams WHERE team_id='" . $row["team2_id"] . "'";
          $team2_name_result = query($db, $team2_name_query);

          $league_id_query = "SELECT league_id FROM fixtures WHERE match_id='" . $row["match_id"] . "'";
          $league_id_result = query($db, $league_id_query);

          /* Push the teams into an array */
          array_push($team_data, array('match_id' => $row["match_id"],
                                       'league_id' => $league_id_result->league_id,
                                       'team1_name' => $team1_name_result->name,
                                       'team2_name' => $team2_name_result->name));
	     }
	  }
    else{
       echo json_encode("No Conflicts");
       return 0;
    }

   echo json_encode($team_data);
?>