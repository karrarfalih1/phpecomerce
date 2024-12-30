<?php
include "../conectphp.php";
$email=filterRequest("email");
$password=sha1($_POST['password']); 
$data=["users_password"=>$password];
$where="users_email=?";
$whereValues = [$email];
updateData("users", $data, $where, $whereValues);
// printSuccess();