<?php
   session_start();  
?>
<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <script src="JS/team_search.js"></script>
      <TITLE>Search Teams</TITLE>
      <link rel="stylesheet" type="text/css" href="CSS/style.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/form.css"></link>
      <link rel="stylesheet" type="text/css" href="CSS/search.css"></link>
   </HEAD>
<BODY>
<div id="wrapper">
   <ul>
     <li><a href="home.php">Home</a></li>
     <li><a class="active" href="team_search.php">Search Teams</a></li>
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
   <div id="forms">
     <form id="team_search">
        <select id="platform">
           <option value="PC">PC</option>
           <option value="Xbox">Xbox</option>
           <option value="PS4">PS4</option>
        </select>
        <select id="region">
            <option value="EU">EU</option>
            <option value="NA">NA</option>
        </select>
        <a href="#" id="search_button">Search</a>
     </form>
   </div>

   <div id="team_list">
   </div>

   <div id="team_results">
      <div id="team_roster">
      </div>
      <div id="team_fixtures">
      </div>
      <div id="team_result">
      </div>
   </div>
</div>
</BODY>
</HTML>