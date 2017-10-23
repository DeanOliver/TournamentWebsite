$(document).ready(function(){

$('#show_league').click(function(){

      var league = $("#title").text();

      switch(league){
        case "EU Xbox League" : league = "euxboxleague"; break;
        case "NA Xbox League" : league = "naxboxleague"; break;
      }

      $("#positions").html("");
      $("#team_names").html("");
      $("#points").html("");

      // POST details to league.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/league.php",
         dataType: 'json',
         data: { league : league },
         success: function(league_table){
            if(league_table == "No Teams"){
              $( "#league_display" ).append( "<div class='no_data'>No Teams in the League</div>" );
            }
            else{       
               /* Add header to table */
               $( "#positions" ).append( "<p class='positions' style='background:#80bdff;'>Position</p>" );
               $( "#team_names" ).append( "<p class='team_names' style='background:#80bdff;'>Team</p>" );
               $( "#points" ).append( "<p class='points' style='background:#80bdff;'>Points</p>" );

               var team_pos = 1;
               /* flip array so teams are in order of position */
               league_table.reverse();
              for(var i = 0; i < league_table.length; i++){   
                 $( "#positions" ).append( "<p class='positions'>" + team_pos + "</p>" );
                 $( "#team_names" ).append( "<p class='team_names'>" + league_table[i]["name"] + "</p>" );
                 $( "#points" ).append( "<p class='points'>" + league_table[i]["points"] + "</p>" );                
                 team_pos ++;
              }
            }
         }
      });
   });

$('#league_pos_button').click(function(){

      var league = $("#pos_league_select").val();

      $("#positions").html("");
      $("#team_names").html("");
      $("#points").html("");

      // POST details to my_league.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/my_league.php",
         dataType: 'json',
         data: { league : league },
         success: function(league_table){
            if(league_table == "No Teams"){
              $( "#team_names" ).append( "<div class='no_data'>No Teams in the League</div>" );
            }
            else{       
               /* Add header to table */
               $( "#positions" ).append( "<p class='positions' style='background:#80bdff;'>Position</p>" );
               $( "#team_names" ).append( "<p class='team_names' style='background:#80bdff;'>Team</p>" );
               $( "#points" ).append( "<p class='points' style='background:#80bdff;'>Points</p>" );

               var team_pos = 1;
               /* flip array so teams are in order of position */
               league_table.reverse();
              for(var i = 0; i < league_table.length; i++){   
                 /* Highlight users team */             
                 if(league_table[i]["name"] == league_table[i]["my_name"]){
                    $( "#positions" ).append( "<p class='positions' style='background:#ff8533;'>" + team_pos + "</p>" );
                    $( "#team_names" ).append( "<p class='team_names' style='background:#ff8533;'>" + league_table[i]["name"] + "</p>" );
                    $( "#points" ).append( "<p class='points' style='background:#ff8533;'>" + league_table[i]["points"] + "</p>" );
                 }
                 else{
                    $( "#positions" ).append( "<p class='positions'>" + team_pos + "</p>" );
                    $( "#team_names" ).append( "<p class='team_names'>" + league_table[i]["name"] + "</p>" );
                    $( "#points" ).append( "<p class='points'>" + league_table[i]["points"] + "</p>" );
                 }
                 
                 team_pos ++;
              }
            }
         }
      });
   });
 });

