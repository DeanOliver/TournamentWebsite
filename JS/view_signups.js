$(document).ready(function(){

$('#view_signups_button').click(function(){

      var league = $("#view_signups_select").val();; 
      $("#signups").html("");
      $("#match_id").html("");
      $("#league_id").html("");
      $("#fixture").html("");
      $("#conflicts").html("");

      // POST details to view_signups.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/view_signups.php",
         dataType: 'json',
         data: { league : league },
         success: function(teams){
            if(teams == "No Signups"){
              $( "#signups" ).append( "<div class='teams' style='background:#80bdff;'>There are no signups</div>" );
            }
            else{    
               /* Add header to table */
               $( "#signups" ).append( "<p class='teams' style='background:#80bdff;'>Teams (" + teams.length + ")</p>" );

              for(var i = 0; i < teams.length; i++){  
                 $( "#signups" ).append( "<p class='teams'>" + teams[i]["team_name"] + "</p>" );
              }
            }
         }
      });
   });
 });