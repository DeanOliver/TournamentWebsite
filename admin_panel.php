<?php
   require_once 'backEnd/dbHandler.php';
   ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   session_start(); 

   if(!isset($_SESSION["admin"])){
      echo "<script>window.location.href ='http://localhost:8080/Tourney/home.php'</script>";
      return 0;
   }   
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <script src="JS/view_signups.js"></script>
      <script src="JS/view_conflicts.js"></script>
      <script src="JS/create_league.js"></script>
      <TITLE>Admin Panel</TITLE>
      <link rel="stylesheet" type="text/css" href="CSS/style.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/form.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/admin_panel.css"></link>
   </HEAD>
<BODY>
<div id="wrapper">
   <ul>
     <li><a href="home.php">Home</a></li>
     <li><a href="team_search.php">Search Teams</a></li>
     <li><a class="active" href='admin_panel.php'>Admin Panel</a></li>
     <li><a href='#' id='logout_button'>Logout</a></li>
   </ul>

   <div id="control_panel">
       <div id="view_conflicts">
         <a class="team_tab" id="view_conflicts_button" href="#">View Conflicts</a>       
      </div>
      <div id="view_signups">
         <a class="team_tab" id="view_signups_button" href="#">View Signups</a>
         <select id="view_signups_select">
            <option value="euxboxleague">EU Xbox League</option>
            <option value="naxboxleague">NA Xbox League</option>
         </select>        
      </div>    
      <div id="create_league">
         <a class="team_tab" id="create_league_button" href="#">Create League Fixtures</a>
         <select id="league_creation_select">
            <option value="euxboxleague">EU Xbox League</option>
            <option value="naxboxleague">NA Xbox League</option>
         </select>
         <div id="fixture_response">
          <div id='AYS_yes_create' href='#' style='background:#70db70;'>Continue</div>
          <div id='AYS_no_create' href='#' style='background:#ff4d4d;'>Cancel</div>
          <div id='response_success' href='#' style='background:#70db70;'>Fixtures Created</div>
          <div id='response_failed' href='#' style='background:#ff4d4d;'>Failed To Create</div>
         </div>
      </div>
   </div>
   <div id="display">
      <div id="signup_display">
         <div id="signups">
         </div>         
      </div>
      <div id="conflict_display">
         <div id="conflicts">
            <div id="match_id">
            </div>
            <div id="league_id">
            </div>
            <div id="fixture">
            </div>   
         </div>         
      </div>
   </div>
</div>
</BODY>
</HTML>