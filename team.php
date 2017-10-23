<?php
   session_start();  
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <script src="JS/teams.js"></script>
      <script src="JS/my_roster.js"></script>
      <script src="JS/my_league.js"></script>
      <script src="JS/my_fixtures.js"></script>
      <script src="JS/JQuery.js"></script>
      <script src="JS/league_sign_up.js"></script>
      <link rel="stylesheet" type="text/css" href="CSS/style.css">
      <link rel="stylesheet" type="text/css" href="CSS/form.css">
      <link rel="stylesheet" type="text/css" href="CSS/team.css">
       
      <TITLE>My Team</TITLE>         
   </HEAD>
<BODY>
<div id="wrapper">
   <ul>
     <li><a href="home.php">Home</a></li>
     <li><a href="team_search.php">Search Teams</a></li>
          <?php
     if(isset($_SESSION["username"])){
       echo "<li><a  class='active' href='team.php' id='Team_button'>My Team</a></li>";
          if(isset($_SESSION["team_id"])){
             echo "<li><a href='submit_results.php'>Submit Results</a></li>";
          }
       echo "<li><a href='#' id='logout_button'>Logout</a></li>";
     }  
     else
       echo "<li><a href='login.html'>Register/ Login</a></li>";
     ?>
   </ul>

   <?php
      if(!isset($_SESSION["username"])){
        echo "<script>window.location.href ='http://localhost:8080/Tourney/home.php'</script>";
      }
   ?>

   <?php
      if(!isset($_SESSION["team_id"])){
          echo '<p id="need_login">Create Team</p>';
          echo '   <div id="forms">
           <form id="login">
              <input type="text" id="team_name" placeholder="Team Name"/><br>
              <input type="text" id="captain" placeholder="Captain"/><br>
              <input type="text" id="player2" placeholder="Team Member IGN"/><br>
              <input type="text" id="player3" placeholder="Team Member IGN"/><br>
              <input type="text" id="player4" placeholder="Team Member IGN"/><br>
              <input type="text" id="player5" placeholder="Team Member IGN"/><br>
              <input type="text" id="sub1" placeholder="Sub IGN"/><br>
              <input type="text" id="sub2" placeholder="Sub IGN"/><br>
              <a href="#" id="team_button">Create Team</a>
           </form>
           <p id="reg_fail"></p>
         </div>';
        return 0;
      }
  ?>
   <div id="my_team_select">     
      <a class="team_tab" id="roster_button" href="#">Team members</a>
   </div>

   <div id="my_league_select">
      <a class="team_tab" id="league_pos_button" href="#">League position</a>
      <select id="pos_league_select">
         <option value="euxboxleague">EU Xbox League</option>
         <option value="naxboxleague">NA Xbox League</option>
      </select>
   </div>
   <div id="my_fixtures_select">     
      <a class="team_tab" id="fixtures_button" href="#">Fixtures</a>
      <select id="match_league_select">
         <option value="EUX1">EU Xbox League</option>
         <option value="NAX1">NA Xbox League</option>
      </select>
   </div>
   <div id="display">
      <div id="my_roster_display">
         <div id="roster">
         </div>         
      </div>

      <div id="my_league_display">
         <div id="positions">
         </div>
         <div id="team_names">
         </div>
         <div id="points">
         </div>         
      </div>

      <div id="my_fixtures_display">
         <div id="my_fixtures">
         </div>
         <div id="my_results">
         </div>
      </div>      
   </div>
</div> 
</BODY>
</HTML>