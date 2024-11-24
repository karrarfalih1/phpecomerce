<?php 

include './conectphp.php';
$table = "users";
// $name = filterRequest("namerequest");
$data = array( 
"users_name" => "karrar",
"users_email" => "karrarfalih@gmail.com",
"users_phone" => "07817132038",
"users_verfiycode" => "1456782",       
);
$count = insertData($table , $data);