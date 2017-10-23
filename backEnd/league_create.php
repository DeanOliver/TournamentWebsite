<?php
   require_once 'dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);  

   $league = $_POST['league'];

   /* Connect to database */
   $db = connect();

   /* Get all teams in the league */
   $league_query = "SELECT * FROM " . $league;
   $league_result = mysqli_query($db, $league_query);
   $league_result_ = query($db, $league_query);

   $league_id = $league_result_->league_id;   /* Holds the ID of the league  */
   $no_teams = 0;         /* Set number of teams to 0    */
   $team_data = array();  /* Array to hold all the teams */

   /* For each team in the league add 1 */
   if (mysqli_num_rows($league_result) > 0) {
      while($row = mysqli_fetch_assoc($league_result)) {

         /* Find the teams names */
         $team_query = "SELECT name FROM teams WHERE team_id='" . $row["team_id"] . "'";
         $team_result = query($db, $team_query);
         /* Push the team into an array of teams */
         array_push($team_data, array('name' => $team_result->name ,'points' => $row["points"]));
         $no_teams ++;

      }
   }

    /* $teams is to holds an extra bye team */
    $teams = $no_teams;

    /* If odd number of teams add a "bye". */
    $bye = false;
    if ($teams % 2 == 1) {
        $teams++;
        $bye = true;
    }

    $totalRounds = $teams - 1;
    $matchesPerRound = $teams / 2;
    $rounds = array();
    for ($i = 0; $i < $totalRounds; $i++) {
        $rounds[$i] = array();
    }

    for ($round = 0; $round < $totalRounds; $round++) {
        for ($match = 0; $match < $matchesPerRound; $match++) {
            $home = ($round + $match) % ($teams - 1);
            $away = ($teams - 1 - $match + $round) % ($teams - 1);
            /* Last team stays in the same place  *
             * while the others rotate around it. */                                 
            if ($match == 0) {
                $away = $teams - 1;
            }
            
            $team1 = team_select($home + 1, $no_teams, $team_data);
            $team2 = team_select($away + 1, $no_teams, $team_data);

            /* Check for BYE */
            if($team1 == "BYE"){
               continue;
            }
            else if($team2 == "BYE"){
               continue;
            }

            /* Find Team 1 ID */
            $team1_query = "SELECT team_id FROM teams WHERE name='" . $team1 . "'";
            $team1_result = query($db, $team1_query);

            /* Find Team 2 ID */
            $team2_query = "SELECT team_id FROM teams WHERE name='" . $team2 . "'";
            $team2_result = query($db, $team2_query);           

            $insert = "INSERT INTO fixtures (league_id, team1, team2)
              VALUES('". $league_id ."',
                     '". $team1_result->team_id ."', 
                     '". $team2_result->team_id ."')";
            insert($db, $insert);

            $rounds[$round][$match] = $team1 . " v " . $team2;
        }
    }

    $fixture_query = "SELECT * FROM fixtures WHERE league_id='EUX1'";
    $fixture_result = mysqli_query($db, $fixture_query);

    /* For each Fixture in the new league */
   if (mysqli_num_rows($fixture_result) > 0) {
      while($row = mysqli_fetch_assoc($fixture_result)) {
        /* Add the fixtures to the temp_results table */
        $insert = "INSERT INTO temp_results (match_id, team1_id, team2_id)
                   VALUES('". $row["match_id"] ."',
                          '". $row["team1"] ."', 
                          '". $row["team2"] ."')";
        insert($db, $insert);

      }
   }

   echo json_encode("Created");
   return 0;

function team_select($num, $no_teams, $team_data) {
    $i = $num - 1;
    if ($no_teams > $i && $no_teams[$i] > 0) {
           return $no_teams[$i];
    } 
    else {
        if($i == $no_teams)
            return "BYE";
        else
            return $team_data[$num-1]['name'];
    }
}

function nums($n) {
    $ns = array();
    for ($i = 1; $i <= $n; $i++) {
        $ns[] = $i;
    }
    return $ns;
}


?>