<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

/********************* Connect *******************/
function connect(){
   require_once 'config.php';

   $db = new mysqli($localhost, $username, $password, $database);
   //mysqli_set_charset($db,'utf8');
   if (!$db)
      echo "Error: Unable to connect to MySQL.";
	
   return $db;
}

/*************** Close Connection ***************/
function dissconnect($db){

   mysqli_close($db);
}

/**************** Query Database****************/
function query($db,$query){

   $result = $db->query($query);
   if ($result->num_rows){
      while($result = $result->fetch_object()){
         return $result;
      }
   }
   else{
      $result = "Failed Query";
      return $result;	
   }
}

/****************** Insert *********************/

function insert($db,$insert){
	
   $db->query($insert);	
}
?>