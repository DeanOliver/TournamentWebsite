$(document).ready(function(){
   // Passing the login details so server
   $('#login_button').click(function(){

      var login_email = $("#login_email").val();
      var login_password = $("#login_password").val(); 

      // POST details to login.php
      $.ajax({
         type: "POST",
         url: "./backEnd/login.php",
         dataType: 'json',
         data: {
                email : login_email,
                password : login_password
               },
         success: function(login_response){
            // Are the login details correct? 
		if(login_response == "Incorrect details")
		  {
		    document.getElementById("login_fail").innerHTML = "Incorrect Details";
        document.getElementById("login_fail").style.visibility = "visible";
		  }		
		else // If yes
 		  {
        $.ajax({
         		type: "POST",
        		url: "./backEnd/sessions.php",
       			dataType: 'json',
       			data: {
				username : login_response
			      },
			success: function(session_response){
			window.location.href = "profile.php";
		        }
		    });

        	  } 
	}
      });
   });
   
   // Passing the register details so server
   $('#register_button').click(function(){

      var username = $("#username").val();
      var email = $("#email").val();
      var password = $("#password").val();

      // POST details to register.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/register.php",
         dataType: 'json',
         data: {
                username : username,
                email : email,
                password : password,
               },
         success: function(register_response){
            $('#test_username').html(register_response);
         }
      });
   });
});