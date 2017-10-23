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

<?php
  if(isset($_SESSION["username"])){ //Show this if not logged in
    //Carry on with script
  }
  else{
    echo '<p id="need_login">Please login to sign up</p>';
    echo '   <div id="forms">
     <form id="login">
        <input type="text" id="login_email" placeholder="Email Address"/><br>
        <input type="password" id="login_password" placeholder="Password"/><br>
        <a href="#" id="login_button">Login</a>
     </form>
     <p id="login_fail"></p>
     

     <form id="register">
        <input type="text" id="username" placeholder="Username"/><br>
        <input type="text" id="email" placeholder="Email Address"/><br>
        <input type="password" id="password" placeholder="Password"/><br>
        <a href="#" id="register_button">Register</a>
     </form>
     <p id="reg_fail"></p>
   </div>';
    return 0;
  }
?>

  <p style="color:white;">Sign up page</p>
</BODY>
</HTML>