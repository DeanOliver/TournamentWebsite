<?php
   session_start();  
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <script src="JS/teams.js"></script>
      <script src="JS/my_fixtures.js"></script>
      <script src="JS/my_league.js"></script>
      <script src="JS/league_sign_up.js"></script>
      <script src="JS/JQuery.js"></script>
      <link rel="stylesheet" type="text/css" href="CSS/style.css">
      <link rel="stylesheet" type="text/css" href="CSS/tournament.css">
 
      <TITLE>EU</TITLE>         
   </HEAD>
<BODY>
<div id="wrapper">
   <ul>
     <li><a href="home.php">Home</a></li>
     <li><a href="team_search.php">Search Teams</a></li>
          <?php
     if(isset($_SESSION["username"])){
       echo "<li><a href='http://localhost:8080/Tourney/team.php' id='Team_button'>My Team</a></li>";
          if(isset($_SESSION["team_id"])){
             echo "<li><a href='submit_results.php'>Submit Results</a></li>";
          }
       echo "<li><a href='#' id='logout_button'>Logout</a></li>";
     }  
     else
       echo "<li><a href='login.html'>Register/ Login</a></li>";
     ?>
   </ul>

   <div id="banner"><p id="title">EU Xbox League</p></div>
   <div id="buttons_containers">
   <?php
      if(isset($_SESSION["team_id"])){
          echo '<div id="sign_up">     
                   <form id="league_signup">
                      <a class="team_tab" id="sign_up_button" href="#" value="euxboxleague"> Sign up for a league</a>
                      <select id="hide_league_select">
                         <option value="euxboxleague">EU Xbox League</option>
                      </select>
                   </form>
                   <p id="reg_success"></p>
                   <p id="team_reg_fail"></p>
                </div>';
      }
  ?>
   
      <div id="league_table">     
         <a class="team_tab" id="show_league" href="#">League Table</a>
      </div>  
      <div id="fixture_table">     
         <a class="team_tab" id="show_fixtures" href="#">Fixtures</a>
      </div>
   </div>
   <div id="display">
      <div id="league_display">
         <div id="positions">
         </div>
         <div id="team_names">
         </div>
         <div id="points">
         </div> 
      </div> 
      <div id="fixture_display">
         <div id="fixtures">
         </div>
         <div id="results">
         </div>
      </div> 
   </div>
</div> 
</BODY>
</HTML>