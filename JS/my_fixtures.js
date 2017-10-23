$(document).ready(function(){

$('#show_fixtures').click(function(){

      $("#fixtures").html("");
      $("#results").html("");

      var league = $("#title").text();

      switch(league){
        case "EU Xbox League" : league = "EUX1"; break;
        case "NA Xbox League" : league = "NAX1"; break;
      }
      // POST details to get_teams.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/fixtures.php",
         dataType: 'json',
         data: { league : league },
         success: function(fixtures){
            if(fixtures == "No Fixtures"){
               $( "#fixtures" ).append("<p class='no_data'>No Fixtures</p>");
            }
            else{       
               /* Add header to table */
               $( "#fixtures" ).append( "<p class='fixtures' style='background:#80bdff;'>Fixtures</p>" );
               $( "#results" ).append( "<p class='results' style='background:#80bdff;'>Result</p>" );
               /* Display team fixtures. If more fixtures than players change borders */
              for(var i = 0; i < fixtures.length; i++){  
                 $( "#fixtures" ).append( "<p class='fixtures'>" + fixtures[i]["team1"] + " VS " + fixtures[i]["team2"] + "</p>" );
                 $( "#results" ).append( "<p class='results'>" + fixtures[i]["winner"] + "</p>" );
                
              }
            }
        }
      });
});







$('#fixtures_button').click(function(){

      var league = $("#match_league_select").val();

      $("#my_fixtures").html("");
      $("#my_results").html("");

      // POST details to get_teams.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/my_fixtures.php",
         dataType: 'json',
         data: { league : league },
         success: function(my_fixtures){
            if(my_fixtures == "No Fixtures"){
              $( "#my_fixtures" ).append("<p class='no_data'>No Fixtures</p>");
            }
            else{       
               /* Add header to table */
               $( "#my_fixtures" ).append( "<p class='my_fixtures' style='background:#80bdff;'>Recent Fixtures</p>" );
               $( "#my_results" ).append( "<p class='my_results' style='background:#80bdff;'>Result</p>" );
               /* Display team fixtures. If more fixtures than players change borders */
              for(var i = 0; i < my_fixtures.length; i++){  
                 $( "#my_fixtures" ).append( "<p class='my_fixtures'>" + my_fixtures[i]["team1"] + " VS " + my_fixtures[i]["team2"] + "</p>" );
                // If win make background green
                if(my_fixtures[i]["winner"] == "WON"){
                   $( "#my_results" ).append( "<p class='my_results' style='background:#70db70;'>" + my_fixtures[i]["winner"] + "</p>" );
                }
                else if(my_fixtures[i]["winner"] == "LOST"){
                   $( "#my_results" ).append( "<p class='my_results' style='background:#ff4d4d;'>" + my_fixtures[i]["winner"] + "</p>" );
                }
                else{
                   $( "#my_results" ).append( "<p class='my_results'>" + my_fixtures[i]["winner"] + "</p>" );
                }
              }
            }
         }
      });
   });
 });

