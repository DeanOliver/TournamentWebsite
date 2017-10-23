<?php
   session_start();  
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <TITLE>Home</TITLE>
      <link rel="stylesheet" type="text/css" href="CSS/style.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/home.css">
      

   </HEAD>
<BODY>
   <div id="wrapper">
   <ul>
     <li><a class="active" href="home.php">Home</a></li>
     <li><a href="team_search.php">Search Teams</a></li>
          <?php
     if(isset($_SESSION["username"])){
       echo "<li><a href='team.php' id='Team_button'>My Team</a></li>";
          if(isset($_SESSION["team_id"])){
             echo "<li><a href='submit_results.php'>Submit Results</a></li>";
          }
          if(isset($_SESSION["admin"])){
             echo "<li><a href='admin_panel.php'>Admin Panel</a></li>";
          }
       echo "<li><a href='#' id='logout_button'>Logout</a></li>";
     }  
     else
       echo "<li><a href='login.html'>Register/ Login</a></li>";
     ?>
   </ul>
   
   <div id="banner"></div>

      <div id="EU_Tourney">
         <div id="EU_logo">
            <a href="EU_tournaments.php">  
               <img id="flags" src="Images/EU_Flag.png" alt="EU Flag"></img>
            </a>
         </div>
      </div>
     
      <div id="NA_Tourney">
         <div id="NA_logo">
            <a href="#">
               <img id="flags" src="Images/NA_Flag.png" alt="NA Flag" href='#'></img>
            </a>
         </div>
     </div>
     <div class="soon_div">
         <p class="soon" id="NA_soon">Coming Soon</p>
      </div>
   </div>

</BODY>
</HTML>