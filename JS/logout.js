$(document).ready(function(){
   $('#logout_button').click(function(){
      // Close session
      $.ajax({
         type: "POST",
         url: "./backEnd/logout.php",
         dataType: 'json',
         success: function(logout_response){
         window.location.href = "home.php";
	}
      });
   });
});