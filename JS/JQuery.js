													/* My Team pages */
// Show league table
$(document).ready(function() {
   $('#league_pos_button').click(function() {
      if ($('#my_roster_display').css('display') === 'block'){
	     $('#my_roster_display').hide(1);
	  }
	  else if($('#my_fixtures_display').css('display') === 'block'){
	     $('#my_fixtures_display').hide(1);
	  }

	  $('#my_league_display').show(1);
   });
});

// Show match fixtures
$(document).ready(function() {
   $('#fixtures_button').click(function() {
      if ($('#my_league_display').css('display') === 'block'){
	     $('#my_league_display').hide(1);
	  }
	  else if($('#my_roster_display').css('display') === 'block'){
	     $('#my_roster_display').hide(1);
	  }
		 
	  $('#my_fixtures_display').show(1);
   });
});

// Show team members
$(document).ready(function() {
   $('#roster_button').click(function() {
      if ($('#my_league_display').css('display') === 'block'){
	     $('#my_league_display').hide(1);
	  }
	  else if($('#my_fixtures_display').css('display') === 'block'){
	     $('#my_fixtures_display').hide(1);
	  }
		 
	  $('#my_roster_display').show(1);
   });
});


													/* League Page */
// Show league table
$(document).ready(function() {
   $('#show_league').click(function() {
      if ($('#fixture_display').css('display') === 'block'){
	     $('#fixture_display').hide(1);
	  }

	  $('#league_display').show(1);
   });
});

// Show Fixture table
$(document).ready(function() {
   $('#show_fixtures').click(function() {
      if ($('#league_display').css('display') === 'block'){
	     $('#league_display').hide(1);
	  }

	  $('#fixture_display').show(1);
   });
});