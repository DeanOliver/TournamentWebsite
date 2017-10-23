$( document ).ready(function() {
    console.log( "ready!" );
});

$(document).ready(function(){
                                                // Row 1
// Make sure only one box can be checked at once
$('#team1_check1').click(function(){  
   $("#team1_check1").prop("checked", true);
   $("#team2_check1").prop("checked", false);
});

$('#team2_check1').click(function(){ 
   $("#team1_check1").prop("checked", false);
   $("#team2_check1").prop("checked", true); 
});

$('#submit1').click(function(){  
   /* Make sure a winner is selected */
   if($("#team1_check1").prop("checked")=== true){
      var winner = $("#team1_check1").val();
   }
   else if($("#team2_check1").prop("checked")=== true){
      var winner = $("#team2_check1").val();
   }
   else{
   	 var no_submission = "Select a winner";
   	 alert(no_submission);
   	 return 0;
   }
   
   // Get table data for submission
   var match_id = document.getElementById("match_id1").textContent;
   var team1_name = document.getElementById("team1_name1").textContent;
   var team2_name = document.getElementById("team2_name1").textContent;

   $.ajax({   
      type: "POST",
      url: "./backEnd/store_results.php",
      dataType: 'json',
      data: { match_id : match_id,
      	     team1_name : team1_name,
      	     team2_name : team2_name,
      		  winner : winner },
      success: function(submit_result_response){
        $("#submit1").html("Submitted");
        $('#submit1').css('background-color', '#70db70');
      }
   });  

});
                                                // Row 2
// Make sure only one box can be checked at once
$('#team1_check2').click(function(){  
   $("#team1_check2").prop("checked", true);
   $("#team2_check2").prop("checked", false);
});

$('#team2_check2').click(function(){ 
   $("#team1_check2").prop("checked", false);
   $("#team2_check2").prop("checked", true); 
});

$('#submit2').click(function(){  
   /* Make sure a winner is selected */
   if($("#team1_check2").prop("checked")=== true){
      var winner = $("#team1_check2").val();
   }
   else if($("#team2_check2").prop("checked")=== true){
      var winner = $("#team2_check2").val();
   }
   else{
       var no_submission = "Select a winner";
       alert(no_submission);
       return 0;
   }
   
   // Get table data for submission
   var match_id = document.getElementById("match_id2").textContent;
   var team1_name = document.getElementById("team1_name2").textContent;
   var team2_name = document.getElementById("team2_name2").textContent;

   $.ajax({   
      type: "POST",
      url: "./backEnd/store_results.php",
      dataType: 'json',
      data: { match_id : match_id,
              team1_name : team1_name,
              team2_name : team2_name,
              winner : winner },
      success: function(submit_result_response){
        $("#submit2").html("Submitted");
        $('#submit2').css('background-color', '#70db70');
      }
   });  

});
                                                // Row 3
// Make sure only one box can be checked at once
$('#team1_check3').click(function(){  
   $("#team1_check3").prop("checked", true);
   $("#team2_check3").prop("checked", false);
});

$('#team2_check3').click(function(){ 
   $("#team1_check3").prop("checked", false);
   $("#team2_check3").prop("checked", true); 
});

$('#submit3').click(function(){  
   /* Make sure a winner is selected */
   if($("#team1_check3").prop("checked")=== true){
      var winner = $("#team1_check3").val();
   }
   else if($("#team2_check3").prop("checked")=== true){
      var winner = $("#team2_check3").val();
   }
   else{
       var no_submission = "Select a winner";
       alert(no_submission);
       return 0;
   }
   
   // Get table data for submission
   var match_id = document.getElementById("match_id3").textContent;
   var team1_name = document.getElementById("team1_name3").textContent;
   var team2_name = document.getElementById("team2_name3").textContent;

   $.ajax({   
      type: "POST",
      url: "./backEnd/store_results.php",
      dataType: 'json',
      data: { match_id : match_id,
              team1_name : team1_name,
              team2_name : team2_name,
              winner : winner },
      success: function(submit_result_response){
        $("#submit3").html("Submitted");
        $('#submit3').css('background-color', '#70db70');
      }
   });  

});
                                                // Row 4
// Make sure only one box can be checked at once
$('#team1_check4').click(function(){  
   $("#team1_check4").prop("checked", true);
   $("#team2_check4").prop("checked", false);
});

$('#team2_check4').click(function(){ 
   $("#team1_check4").prop("checked", false);
   $("#team2_check4").prop("checked", true); 
});

$('#submit4').click(function(){  
   /* Make sure a winner is selected */
   if($("#team1_check4").prop("checked")=== true){
      var winner = $("#team1_check4").val();
   }
   else if($("#team2_check4").prop("checked")=== true){
      var winner = $("#team2_check4").val();
   }
   else{
       var no_submission = "Select a winner";
       alert(no_submission);
       return 0;
   }
   
   // Get table data for submission
   var match_id = document.getElementById("match_id4").textContent;
   var team1_name = document.getElementById("team1_name4").textContent;
   var team2_name = document.getElementById("team2_name4").textContent;

   $.ajax({   
      type: "POST",
      url: "./backEnd/store_results.php",
      dataType: 'json',
      data: { match_id : match_id,
              team1_name : team1_name,
              team2_name : team2_name,
              winner : winner },
      success: function(submit_result_response){
        $("#submit4").html("Submitted");
        $('#submit4').css('background-color', '#70db70');
      }
   });  

});
                                                // Row 5
// Make sure only one box can be checked at once
$('#team1_check5').click(function(){  
   $("#team1_check5").prop("checked", true);
   $("#team2_check5").prop("checked", false);
});

$('#team2_check5').click(function(){ 
   $("#team1_check5").prop("checked", false);
   $("#team2_check5").prop("checked", true); 
});

$('#submit5').click(function(){  
   /* Make sure a winner is selected */
   if($("#team1_check5").prop("checked")=== true){
      var winner = $("#team1_check5").val();
   }
   else if($("#team2_check5").prop("checked")=== true){
      var winner = $("#team2_check5").val();
   }
   else{
       var no_submission = "Select a winner";
       alert(no_submission);
       return 0;
   }
   
   // Get table data for submission
   var match_id = document.getElementById("match_id5").textContent;
   var team1_name = document.getElementById("team1_name5").textContent;
   var team2_name = document.getElementById("team2_name5").textContent;

   $.ajax({   
      type: "POST",
      url: "./backEnd/store_results.php",
      dataType: 'json',
      data: { match_id : match_id,
              team1_name : team1_name,
              team2_name : team2_name,
              winner : winner },
      success: function(submit_result_response){
        $("#submit5").html("Submitted");
        $('#submit5').css('background-color', '#70db70');
      }
   });  

});
                                                // Row 6
// Make sure only one box can be checked at once
$('#team1_check6').click(function(){  
   $("#team1_check6").prop("checked", true);
   $("#team2_check6").prop("checked", false);
});

$('#team2_check6').click(function(){ 
   $("#team1_check6").prop("checked", false);
   $("#team2_check6").prop("checked", true); 
});

$('#submit6').click(function(){  
   /* Make sure a winner is selected */
   if($("#team1_check6").prop("checked")=== true){
      var winner = $("#team1_check6").val();
   }
   else if($("#team2_check6").prop("checked")=== true){
      var winner = $("#team2_check6").val();
   }
   else{
       var no_submission = "Select a winner";
       alert(no_submission);
       return 0;
   }
   
   // Get table data for submission
   var match_id = document.getElementById("match_id6").textContent;
   var team1_name = document.getElementById("team1_name6").textContent;
   var team2_name = document.getElementById("team2_name6").textContent;

   $.ajax({   
      type: "POST",
      url: "./backEnd/store_results.php",
      dataType: 'json',
      data: { match_id : match_id,
              team1_name : team1_name,
              team2_name : team2_name,
              winner : winner },
      success: function(submit_result_response){
        $("#submit6").html("Submitted");
        $('#submit6').css('background-color', '#70db70');
      }
   });  

});

});