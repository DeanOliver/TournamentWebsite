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
    
    /* Get the users team name */
    $user_team_query = "SELECT name FROM teams WHERE team_id='" . $_SESSION["team_id"] . "'";
    $user_team_result = query($db, $user_team_query);

    /* Get the fixture for the users team */
    $my_fixture_query = "SELECT * FROM fixtures WHERE ((team1='" . $_SESSION["team_id"] . "')
                                                   OR (team2='" . $_SESSION["team_id"] . "'))
                                                   AND (league_id='" . $league . "')";
    $my_fixture_result = mysqli_query($db, $my_fixture_query);
    $my_fixture_result_ = query($db, $my_fixture_query);

    if($my_fixture_result_ == "Failed Query"){
      echo json_encode("No Fixtures");
      return 0;
    }

    /*Create an array for fixtures to go in*/
    $fixture_data = array();

  	if (mysqli_num_rows($my_fixture_result) > 0) {
  	    while($row = mysqli_fetch_assoc($my_fixture_result)) {
  	       /* Find the team1 names */
  	       $team1_query = "SELECT name FROM teams WHERE team_id='" . $row["team1"] . "'";
           $team1_result = query($db, $team1_query);

           /* Find the team2 names */
           $team2_query = "SELECT name FROM teams WHERE team_id='" . $row["team2"] . "'";
           $team2_result = query($db, $team2_query);

           /* If users team is the winner */
           if($row["winner"] == $_SESSION["team_id"]){
              $row["winner"] = "WON";
           } 
           /* If users team is not the winner */
           elseif((!($row["winner"] == $_SESSION["team_id"])) && (!($row["winner"] == 0))){
              $row["winner"] = "LOST";
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
  
  /* Sort the teams in the array based on game order*/
	$sorted_fixtures = orderBy($fixture_data, 'match_id');
  $sorted_fixtures = array_reverse($sorted_fixtures);

  echo json_encode($sorted_fixtures);
  return 0;
?>