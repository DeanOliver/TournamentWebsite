$(document).ready(function(){

$('#view_conflicts_button').click(function(){

      $("#conflicts").html("");
      $("#match_id").html("");
      $("#league_id").html("");
      $("#fixture").html("");
      $("#signups").html("");

      // POST details to view_signups.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/view_conflicts.php",
         dataType: 'json',
         success: function(conflicts){
            if(conflicts == "No Conflicts"){
              $( "#conflicts" ).append( "<div class='teams' style='background:#80bdff;'>No Conflicts</div>" );
            }
            else{    
               /* Add header to table */
               $( "#match_id" ).append( "<p class='match_id' style='background:#80bdff;'>Match ID</p>" );
               $( "#league_id" ).append( "<p class='league_id' style='background:#80bdff;'>League ID</p>" );
               $( "#fixture" ).append( "<p class='fixture' style='background:#80bdff;'>Fixture</p>" );

               for(var i = 0; i < conflicts.length; i++){ 
                  $( "#match_id" ).append( "<p class='match_id'>" + conflicts[i]["match_id"] + "</p>" );
                  $( "#league_id" ).append( "<p class='league_id'>" + conflicts[i]["league_id"] + "</p>" );                
                  $( "#fixture" ).append( "<p class='fixture'>" + conflicts[i]["team1_name"] + " VS " + conflicts[i]["team2_name"] + "</p>" );
               }
            }
         }
      });
   });
 });