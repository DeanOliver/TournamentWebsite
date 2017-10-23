$(document).ready(function(){
   // Passing the login details so server
   $('#login_button').click(function(){

      var login_username = $("#login_username").val();
          login_username = $.trim(login_username);
      var login_password = $("#login_password").val();
      var login_validation = /^[0-9a-zA-Z _]+$/;

      $("#login_fail").html("");

      // If login is empty do nothing
      if((login_username == "") || (login_password == "")){
        return 0;
      }
      // username is only letters and numbers
      if(!login_username.match(login_validation)){
        $("#login_fail").html("Incorrect Details");
        document.getElementById("login_fail").style.visibility = "visible";
        return 0;
      }

      // POST details to login.php
      $.ajax({
         type: "POST",
         url: "./backEnd/login.php",
         dataType: 'json',
         data: {
                username : login_username,
                password : login_password
         },
         success: function(login_response){
            // Are the login details correct? 
		if(login_response == "Incorrect details"){
		    $("#login_fail").html("Incorrect Details");
        document.getElementById("login_fail").style.visibility = "visible";
		  }		
		else{ // If yes
        $.ajax({
         		type: "POST",
        		url: "./backEnd/sessions.php",
       			dataType: 'json',
       			data: {
				         username : login_response
			      },
			success: function(session_response){
			   window.location.href = "http://www.smitecc.com/home.php";
		        }
		     });

        } 
	     }
      });
   });
   
   // Passing the register details so server
   $('#register_button').click(function(){

      var username = $("#username").val();
          username = $.trim(username);
      var password = $("#password").val();
          password = $.trim(password);
      var inGameName = $("#inGameName").val();
          inGameName = $.trim(inGameName);
      var platform = $("#platform").val();
      var region = $("#region").val();
      var login_validation = /^[0-9a-zA-Z _]+$/;

      // If registration is empty do nothing
      if((username == "") || (password == "") || (inGameName == "")){
         document.getElementById("reg_fail").innerHTML = "Fill in all fields";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      // Username validation
      if(!username.match(login_validation)){
         document.getElementById("reg_fail").innerHTML = "Username - Numbers and letters Only";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }
      if((username.length>15) || (username.length<3)){
         document.getElementById("reg_fail").innerHTML = "Username - 3-15 characters";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      // Password validation
      if(password.length>20){
         document.getElementById("reg_fail").innerHTML = "Password - 20 characters max";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      // IGN validation
      if(!inGameName.match(login_validation)){
         document.getElementById("reg_fail").innerHTML = "IGN - Numbers and letters Only";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }
      if((username.length>15) || (username.length<3)){
         document.getElementById("reg_fail").innerHTML = "IGN - 3-15 characters max";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }


      // POST details to register.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/register.php",
         dataType: 'json',
         data: {
                username : username,
                password : password,
                inGameName : inGameName,
                platform : platform,
                region : region
               },
         success: function(register_response){
            if(register_response == "It Worked"){
               $.ajax({
                  type: "POST",
                  url: "./backEnd/sessions.php",
                  dataType: 'json',
                  data: {username : username},
                  success: function(session_response){
                     window.location.href = "http://www.smitecc.com/home.php";
                  }
               });
            } 
            else{
               document.getElementById("reg_fail").innerHTML = register_response;
               document.getElementById("reg_fail").style.visibility = "visible";
            }          
         }
      });
   });
});