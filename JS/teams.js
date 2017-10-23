$(document).ready(function(){

$('#team_button').click(function(){

  $("#reg_fail").html("");

      var team = $("#team_name").val();
      team = $.trim(team);
      var captain = $("#captain").val();
      captain = $.trim(captain);
      var player2 = $("#player2").val();
      player2 = $.trim(player2);
      var player3 = $("#player3").val();
      player3 = $.trim(player3);
      var player4 = $("#player4").val();
      player4 = $.trim(player4);
      var player5 = $("#player5").val();
      player5 = $.trim(player5);
      var sub1 = $("#sub1").val();
      sub1 = $.trim(sub1);
      var sub2 = $("#sub2").val();
      sub2 = $.trim(sub2);
      var login_validation = /^[0-9a-zA-Z _]+$/;

      // If team name is empty do nothing
      if(team == ""){
         document.getElementById("reg_fail").innerHTML = "Team Name - Empty";
         document.getElementById("reg_fail").style.visibility = "visible";
        return 0;
      }

      if((captain == "") || (player2 == "") || (player3 == "") || (player4 == "") || (player5 == "")){
        document.getElementById("reg_fail").innerHTML = "Roster - First 5 players must filled in";
        document.getElementById("reg_fail").style.visibility = "visible";
        return 0;
      }

      // Team Name validation
      if(!team.match(login_validation)){
         document.getElementById("reg_fail").innerHTML = "Team Name - Numbers and letters Only";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }
      if((team.length>15) || (team.length<3)){
         document.getElementById("reg_fail").innerHTML = "Team Name - 3-15 characters";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      if((captain.length>15) || (!captain.match(login_validation))){
         document.getElementById("reg_fail").innerHTML = "Captain - User does not exist";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      if((player2.length>15) || (!player2.match(login_validation))){
         document.getElementById("reg_fail").innerHTML = "Team Member 2 - User does not exist";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      if((player3.length>15) || (!player3.match(login_validation))){
         document.getElementById("reg_fail").innerHTML = "Team Member 3 - User does not exist";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      if((player4.length>15) || (!player4.match(login_validation))){
         document.getElementById("reg_fail").innerHTML = "Team Member 4 - User does not exist";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      if((player5.length>15) || (!player5.match(login_validation))){
         document.getElementById("reg_fail").innerHTML = "Team Member 5 - User does not exist";
         document.getElementById("reg_fail").style.visibility = "visible";
         return 0;
      }

      if(!sub1 == ""){
         if((sub1.length>15) || (!sub1.match(login_validation))){
            document.getElementById("reg_fail").innerHTML = "Sub 1 - User does not exist";
            document.getElementById("reg_fail").style.visibility = "visible";
            return 0;
         }
      }

      if(!sub2 == ""){
         if((sub2.length>15) || (!sub2.match(login_validation))){
            document.getElementById("reg_fail").innerHTML = "Sub 2 - User does not exist";
            document.getElementById("reg_fail").style.visibility = "visible";
            return 0;
         }
      }

      // POST details to register.php
      $.ajax({   
         type: "POST",
         url: "./backEnd/team_register.php",
         dataType: 'json',
         data: {
                team : team,
                captain : captain,
                player2 : player2,
                player3 : player3,
                player4 : player4,
                player5 : player5,
                sub1 : sub1,
                sub2 : sub2
               },
         success: function(register_response){
            if(register_response == "It Worked"){
              alert("Logout and back in for changes to take effect");
               window.location.href = "http://www.smitecc.com/home.php";
            }         
            else{
               document.getElementById("reg_fail").innerHTML = register_response;
               document.getElementById("reg_fail").style.visibility = "visible";
            }          
         }
      });
   });
 });

