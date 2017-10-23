$(document).ready(function(){

$('#roster_button').click(function(){

      $("#roster").html("");

      // POST details to get_teams.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/my_roster.php",
         dataType: 'json',
         success: function(roster){
            if(roster == "No roster"){
              $("#my_roster_display").html("");
              $( "#my_roster_display" ).append( "<div class='no_data'>There is no roster</div>" );
            }
            else{    
               /* Add header to table */
               $( "#roster" ).append( "<p class='roster' style='background:#80bdff;'>Roster</p>" );

              for(var i = 0; i < roster.length; i++){  
                 $( "#roster" ).append( "<p class='roster'>" + roster[i]["inGameName"] + "</p>" );
              }
            }
         }
      });
   });
 });

