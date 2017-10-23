<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once 'dbHandler.php';
$db = connect();

if(session_id() == '') {
   session_start();
}


$username = $_POST['username'];
$_SESSION["username"] = $username;

$team_query = "SELECT team_id FROM users WHERE username='". $username ."'";
$team_result = query($db, $team_query);

$admin_query = "SELECT is_admin FROM users WHERE username='". $username ."'";
$admin_result = query($db, $admin_query);

if($admin_result->is_admin == 1){
	$_SESSION["admin"] = 1;
}

if($team_result == "Failed Query"){
   echo json_encode("No Team");
}
else{
	$_SESSION["team_id"] = $team_result->team_id;
	echo json_encode("Done");
}
?>