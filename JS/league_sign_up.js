$(document).ready(function(){

$('#sign_up_button').click(function(){

      var league = $("#hide_league_select").val();

      $.ajax({   
         type: "POST",
         url: "./backEnd/league_sign_up.php",
         dataType: 'json',
         data: { league : league },
         success: function(sign_up_response){
            if(sign_up_response == "It Worked"){      
               $("#reg_success").html("You're Signed Up");
               $("#reg_success").slideDown( 300 ).delay(3000).slideUp(500);

            }         
            else{
               $("#team_reg_fail").html(sign_up_response);            
               $("#team_reg_fail").slideDown( 300 ).delay(3000).slideUp(500);
            }          
         }
      });
   });
 });