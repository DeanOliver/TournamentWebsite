<?php
   require_once 'backEnd/dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start();

   if(!isset($_SESSION["team_id"])){
      echo "<script>window.location.href ='http://localhost:8080/Tourney/home.php'</script>";
      return 0;
   }   
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <script src="JS/fixture_league_select.js"></script>
      <script src="JS/result_submit.js"></script>
      <TITLE>Submit Results</TITLE>
      <link rel="stylesheet" type="text/css" href="CSS/style.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/form.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/iframe.css">
      

   </HEAD>
<BODY>
<div id="wrapper">
   <ul>
     <li><a href="home.php">Home</a></li>
     <li><a href="team_search.php">Search Teams</a></li>
          <?php
     if(isset($_SESSION["username"])){
       echo "<li><a href='team.php' id='Team_button'>My Team</a></li>";
       echo "<li><a class='active' href='Submit_results.php'>Submit Results</a></li>";
       echo "<li><a href='#' id='logout_button'>Logout</a></li>";
     }  
     else
       echo "<li><a href='login.html'>Register/ Login</a></li>";
     ?>
   </ul>

   <div id="league_select">
      <form action="submit_results.php" method="post">
         <select id="results_league_select" name="league">
            <?php  
               if(isset($_POST["league"])){
                  switch($_POST["league"]){
                    case EUX1: echo '<option value="EUX1" selected>EU Xbox League</option>
                                     <option value="NAX1">NA Xbox League</option>'; break;
                    case NAX1: echo '<option value="EUX1">EU Xbox League</option>
                                     <option value="NAX1" selected>NA Xbox League</option>'; break;
                  }
               }
               else{
                  echo '<option value="EUX1">EU Xbox League</option>
                        <option value="NAX1">NA Xbox League</option>';

               }
            ?>
         </select>
         <input type="submit" id="search_button" value="Select League">
      </form>

   </div>
   <div id="fixture_form">
   
<?php
   /* if no league is submited end the code */
   if(!isset($_POST["league"])){
      return 0;   
   }

   $league = $_POST["league"];
   /* Create the submission table */
   createTable($league);
   
   /* Sorts multi-level arrays into natural order based *
   * on the field you which to order by                */
   function orderBy($team_data, $field){
      $code = "return strnatcmp(\$a['$field'], \$b['$field']);";
      usort($team_data, create_function('$a,$b', $code));
      return $team_data;
   }

   /* Creates a dinamic submission table */
   function createTable($league){
      /* Connect to database */
      $db = connect();
    
      /* Get the users team name */
     $user_team_query = "SELECT name FROM teams WHERE team_id='" . $_SESSION["team_id"] . "'";
     $user_team_result = query($db, $user_team_query);  

     /* Get the fixture for the users team that have not been submited yet */
     $my_fixture_query = "SELECT * FROM fixtures WHERE ((team1='" . $_SESSION["team_id"] . "')
                                                     OR (team2='" . $_SESSION["team_id"] . "')) 
                                                    AND (winner='0')
                                                    AND (league_id='" . $league . "')";
     $my_fixture_result = mysqli_query($db, $my_fixture_query);

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

           /* Push the team into an array of teams */
           array_push($fixture_data, array('match_id' => $row["match_id"] , 'league_id' => $row["league_id"] ,
                                           'team1_id' => $row["team1"], 'team2_id' => $row["team2"],
                                           'team1' => $team1_result->name , 'team2' => $team2_result->name ));
        }
    }
  
    /* Sort the teams in the array based on points */
    $sorted_fixtures = orderBy($fixture_data, 'match_id');

    echo "<table style='width:100%; background:white;'>
          <tr>
            <th class='table_data'>Match ID</th>
            <th class='table_data'>Team 1</th>
            <th class='table_data'></th>
            <th class='table_data'>Team 2</th> 
            <th class='table_data'>Team 1 Win</th>
            <th class='table_data'>Team 2 Win</th>
            <th class='table_data'></th>
          </tr>";

    $cap =1;
    for($i = 0; $i<sizeof($sorted_fixtures); $i++){
       if(($user_team_result->name == $sorted_fixtures[$i]['team1']) || ($user_team_result->name == $sorted_fixtures[$i]['team2'])){         
          echo '<tr>
                   <form>
                   <td class="table_data" id="match_id' . $cap . '">' . $sorted_fixtures[$i]['match_id'] . '</td>
                   <td class="table_data" id="team1_name' . $cap . '">' . $sorted_fixtures[$i]['team1'] . '</td>
                   <td class="table_data">VS</td>
                   <td class="table_data" id="team2_name' . $cap . '">' . $sorted_fixtures[$i]['team2'] . '</td>
                   <td class="table_data"><input type="checkbox" id="team1_check' . $cap . '" value=' . $sorted_fixtures[$i]['team1_id'] . '></td>
                   <td class="table_data"><input type="checkbox" id="team2_check' . $cap . '" value=' . $sorted_fixtures[$i]['team2_id'] . '></td>
                   <td class="table_data"><a class="team_tab" id="submit' . $cap . '" href="#" onclick="submit_result(this.id , team1_check' . $cap . ' , team2_check' . $cap . ')">Submit</a></td>
                   </form>
                </tr>';
          $cap ++;
          /* Only allow results to be submitted for the next 6 games */          
          if($cap == 6){
            break;
          }
       }
    }
  }
    ?>
  </div>
</div>
</BODY>
</HTML>