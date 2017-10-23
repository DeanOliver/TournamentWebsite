$(document).ready(function(){

$('#create_league_button').click(function(){
    $( "#AYS_yes_create" ).show();
    $( "#AYS_no_create" ).show();
});

$('#AYS_no_create').click(function(){
    $( "#AYS_yes_create" ).hide();
    $( "#AYS_no_create" ).hide();
});



$('#AYS_yes_create').click(function(){

      var league = $("#league_creation_select").val();

      switch(league){
        case "EU Xbox League" : league = "euxboxleague"; break;
        case "NA Xbox League" : league = "naxboxleague"; break;
      }

      $( "#AYS_yes_create" ).hide();
      $( "#AYS_no_create" ).hide();

      // POST details to league.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/league_create.php",
         dataType: 'json',
         data: { league : league },
         success: function(response){
            if(response == "Created"){
               $( "#response_success" ).show();
            }
            else{       
               $( "#response_failed" ).show();
            }
         }
      });
   });
});