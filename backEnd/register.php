<?php
require_once 'dbHandler.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$username = $_POST['username'];
$password = $_POST['password'];
$inGameName = $_POST['inGameName'];
$platform = $_POST['platform'];
$region = $_POST['region'];

$password = encryptIt($password);

$db = connect();

/*Check to see if someone is already using the username*/
$username_query = "SELECT username FROM users WHERE username='". $username ."'";
$username_result = query($db, $username_query);

/*Check to see if someone is already using the IGN in the same region and platform*/
$ign_query = "SELECT inGameName FROM users WHERE (inGameName='". $inGameName ."')
                                             AND (platform='" . $platform . "')
                                             AND (region='" . $region . "')";
$ign_result = query($db, $ign_query);

if(!($username_result == "Failed Query")){
  /*Check if IGN exists*/
  if($username_result->username == $username){
      echo json_encode("Username Already Taken");
      return 0;
  }
  else{
      echo json_encode("Username Already Taken");
      return 0;
  }  
}
else if(!($ign_result == "Failed Query")){ 
  /*Check if IGN exists*/
  if($ign_result->inGameName == $inGameName){
      echo json_encode("IGN Already Taken");
      return 0;
  }
  else{
      echo json_encode("IGN Already Taken");
      return 0;
  }
}
else{  
       $insert = "INSERT INTO users 
                (username, password, inGameName,
                 platform, region)
                 VALUES('". $username ."',
                        '". $password ."', 
                        '". $inGameName ."',
                        '". $platform ."', 
                        '". $region ."')";
       insert($db, $insert);

       echo json_encode("It Worked");
}

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}
?>