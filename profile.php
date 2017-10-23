<?php
   session_start();

   if(!isset($_SESSION["username"])){

     echo "<p>To see your profile log in or make an account</p>
           <a href='login.html'>Register/ Login</a>";

     return 0;
   }
?>

<!DOCTYPE html>
<HTML>
   <HEAD>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
      <script src="JS/logout.js"></script>
      <TITLE>Profile</TITLE>
      <link rel="stylesheet" type="text/css" href="CSS/style.css">
   </HEAD>
   <BODY>
     <ul>
       <li><a href="home.php">Home</a></li>
     <?php
     if(isset($_SESSION["username"])){
       echo "<li><a class='active' href='profile.php'>" . $_SESSION["username"] . "'s Profile</a></li>";
       echo "<li><a href='#' id='logout_button'>Logout</a></li>";
     }
     ?>
     </ul>

      <H1>Profile</H1>
      
   </BODY>
</HTML>