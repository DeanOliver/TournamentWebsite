<?php
   session_start();  
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <TITLE>EU</TITLE>
      <link rel="stylesheet" type="text/css" href="CSS/style.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/tournament_display.css">
      

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
       echo "<li><a href='#' id='logout_button'>Logout</a></li>";
     }  
     else
       echo "<li><a href='login.html'>Register/ Login</a></li>";
     ?>
   </ul>
   
   <div id="banner"></div>

      <div id="xbox_tourneys">
         <div id="EU_Xbox_League">
            <a href="EU_Xbox_League.php">  
               <img class="tourney_img" id="EU_xbox_league_img" src="Images/xbox_smite_league.png" alt="Smite Xbox League"></img>
            </a>          
         </div>

         <div id="EU_Xbox_Tourney">
            <a href="#"> 
               <img class="tourney_img" id="EU_xbox_tourney_img" src="Images/xbox_smite_tourney.png" alt="Smite Xbox League"></img>
            </a>
         </div>
      </div>

      <div class="soon_div">
         <p class="soon" id="EUXT_soon">Coming Soon</p>
      </div>
    </div> 

</BODY>
</HTML>