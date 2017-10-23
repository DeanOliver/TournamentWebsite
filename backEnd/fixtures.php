<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();    

    $league = $_POST['league'];

    /* Sorts multi-level arrays into natural order based *
     * on the field you which to order by                */
    function orderBy($team_data, $field)
    {
      $code = "return strnatcmp(\$a['$field'], \$b['$field']);";
      usort($team_data, create_function('$a,$b', $code));
      return $team_data;
    }

    /* Connect to database */
    $db = connect();

    $fixture_query = "SELECT * FROM fixtures WHERE league_id='" . $league . "'";
    $fixture_result_ = query($db, $fixture_query);
    $fixture_result = mysqli_query($db, $fixture_query);

    if($fixture_result_ == "Failed Query"){
      echo json_encode("No Fixtures");
      return 0;
    }

    /*Create an array for fixtures to go in*/
    $fixture_data = array();

	if (mysqli_num_rows($fixture_result) > 0) {
	    while($row = mysqli_fetch_assoc($fixture_result)) {
	       /* Find the team1 names */
	       $team1_query = "SELECT name FROM teams WHERE team_id='" . $row["team1"] . "'";
         $team1_result = query($db, $team1_query);

         /* Find the team2 names */
         $team2_query = "SELECT name FROM teams WHERE team_id='" . $row["team2"] . "'";
         $team2_result = query($db, $team2_query);

         /* If team 1 was winner */
         if($row["winner"] == $row["team1"]){
            /* Change team ID to team name */
            $row["winner"] = $team1_result->name;
         } 
         /* If team 2 was winner */
         elseif($row["winner"] == $row["team2"]){
            /* Change team ID to team name */
            $row["winner"] = $team2_result->name;
         }
         /* If winner is 0 */
         elseif($row["winner"] == 0){
            /* Set winner to Not Played */
            $row["winner"] = "Not Played";
         }    

         /* Push the team into an array of teams */
         array_push($fixture_data, array('match_id' => $row["match_id"] , 'league_id' => $row["league_id"] ,
                                         'team1' => $team1_result->name , 'team2' => $team2_result->name ,
                                         'winner' =>  $row["winner"]));
	    }
	}
  else{
     echo json_encode("No Fixtures");
  }
  
  /* Sort the teams in the array based on points */
	$sorted_fixtures = orderBy($fixture_data, 'match_id');
  echo json_encode($sorted_fixtures);

?>