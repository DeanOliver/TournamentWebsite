$(document).ready(function(){

$('#search_button').click(function(){

      var platform = $("#platform").val();
      var region = $("#region").val();

      if ($('#team_results').css('display') === 'block'){
         $('#team_results').hide(1);
         $('#team_list').show(1);
      }

      // POST details to get_teams.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/get_teams.php",
         dataType: 'json',
         data: {
                platform : platform,
                region : region
               },
         success: function(team_names){
            if(team_names == "No teams"){
              $("#team_list").html("");
              $("#team_list" ).append( "<div class='no_teams'>No Teams</div>" );
            }
            else{
               $("#team_list").html("");
               for(var i = 0; i < team_names.length; i++){
                  $( "#team_list" ).append( "<div class='team_name' onclick='teamData(this.textContent)'>" + team_names[i] + "</div>" );
               }
            }
         }
      });
   });
 });

function teamData(team_name){

     /* Clear previous results */
     $("#team_roster").html("");
     $("#team_fixtures").html("");
     $("#team_result").html("");

     /* change visible divs */
     $('#team_list').hide(1);
     $('#team_results').show(1);

     // POST details to get_team_data.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/get_team_data.php",
         dataType: 'json',
         data: { team_name : team_name },
         success: function(team_data){
            /* Add header to table */
            $( "#team_roster" ).append( "<p class='team_roster' style='background:#80bdff; text-align:center; border-right:15px solid #1a242f;'>Roster</p>" );
            /* Display team roster. If more players than matches change borders */
            for(var i = 0; i < team_data[0].length; i++){
               if(team_data[0].length > team_data[1].length){
                  $( "#team_roster" ).append( "<p class='team_roster' style='border-right:15px solid #1a242f;'>" + team_data[0][i] + "</p>" );
               }
               else{
                  $( "#team_roster" ).append( "<p class='team_roster' style='border-right:0px solid #1a242f;'>" + team_data[0][i] + "</p>" );
               }
            }
            /* Add header to table */
            $( "#team_fixtures" ).append( "<p class='team_fixtures' style='background:#80bdff;'>Recent Fixtures</p>" );
            $( "#team_result" ).append( "<p class='team_result' style='background:#80bdff;'>Result</p>" );
            
            if(team_data[1] == "No Fixtures"){
               $( "#team_fixtures" ).append( "<p class='team_fixtures' style='border-left:0px solid black;'>No Matches Played</p>");
               return 0;
            }
            /* Display team fixtures. If more fixtures than players change borders */
            for(var i = 0; i < team_data[1].length; i++){  
               if(team_data[1].length > team_data[0].length){
                  $( "#team_fixtures" ).append( "<p class='team_fixtures style='border-right:15px solid black;'>" + team_data[1][i][1] + " VS " + team_data[1][i][2] + "</p>" );
               }
               else{
                  $( "#team_fixtures" ).append( "<p class='team_fixtures style='border-right:0px solid black;'>" + team_data[1][i][1] + " VS " + team_data[1][i][2] + "</p>" );
               }
                  
              // If win make background green
              if(team_data[1][i][3] == "WON"){
                 $( "#team_result" ).append( "<p class='team_result' style='background:#70db70;'>" + team_data[1][i][3] + "</p>" );
              }
              if(team_data[1][i][3] == "LOST"){
                 $( "#team_result" ).append( "<p class='team_result' style='background:#ff4d4d;'>" + team_data[1][i][3] + "</p>" );
              }
            }
         }
      });


}