<?php
   session_start();  
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/accounts.js"></script>
      <script src="JS/logout.js"></script>
      <TITLE>Home</TITLE>
      <link rel="stylesheet" type="text/css" href="CSS/style.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/login.css">
      
   </HEAD>
<BODY>
   <ul>
     <li><a href="home.php">Home</a></li>
          <?php
     if(isset($_SESSION["username"])){
       echo "<li><a href='profile.php'>" . $_SESSION["username"] . "'s Profile</a></li>";
       echo "<li><a href='#' id='logout_button'>Logout</a></li>";
     }  
     else
       echo "<li><a href='login.html'>Register/ Login</a></li>";
     ?>
   </ul>

   // Table with all teams and current position/ points
   // clicking on the team takes you to their match history + team members (team page)