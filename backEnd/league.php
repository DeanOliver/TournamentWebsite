<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();    

   $league = $_POST['league'];

    /* Sorts multi-level arrays into natural order based *
     * on the field you which to order by                */
    function orderBy($team_data, $field){
       $code = "return strnatcmp(\$a['$field'], \$b['$field']);";
       usort($team_data, create_function('$a,$b', $code));
       return $team_data;
    }

    /* Connect to database */
    $db = connect();

    /*Create an array for teams to go in*/
    $team_data = array();

    /* Get all teams in the league */
    $league_query = "SELECT * FROM " . $league;
    $league_result = mysqli_query($db, $league_query);

  if (mysqli_num_rows($league_result) > 0) {
      while($row = mysqli_fetch_assoc($league_result)) {
         /* Find the teams names */
         $team_query = "SELECT name FROM teams WHERE team_id='" . $row["team_id"] . "'";
         $team_result = query($db, $team_query);
         /* Push the team into an array of teams */
         array_push($team_data, array('name' => $team_result->name ,'points' => $row["points"]));
      }
  }
  else{
     echo json_encoded("No Teams");
     return 0;
  }
  
  /* Sort the teams in the array based on points */
  $sorted_teams = orderBy($team_data, 'points');
  echo json_encode($sorted_teams);

?>
