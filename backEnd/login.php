<?php
require_once 'dbHandler.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$username = $_POST['username'];
$password = $_POST['password'];

$password = encryptIt($password);

// Connect to database
$db = connect();

//Look for a matching username address
$query = "SELECT * FROM users WHERE username='". $username ."'";
$result = query($db, $query);

if($result == "Failed Query"){
	echo json_encode("Incorrect details");
	return 0;
}
else{
   $query = "SELECT password FROM users WHERE username='". $username ."'";
   $result = query($db, $query);

   if($result == "Failed Query"){
	   echo json_encode("Failed Query!");
      return 0;
   }

   if(($result->password) == $password){
      echo json_encode($username);
   }
   else{
      echo json_encode("Incorrect details");
   }
}

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}
?>