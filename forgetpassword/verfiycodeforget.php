<?php

use LDAP\Result;

include "../conectphp.php";
//هذا ايميل الشخص الي راح نحصل علي من الفرونت ايند وهوة نفسة الي دخله المستخدم
$email =filterRequest("email");

//هذا الكود الي كتبه المستخدم
$verfiycode=filterRequest("verfiycode");

$stmt=$con->prepare("SELECT * FROM users WHERE `users_email` =? AND users_verfiycode =?");

$stmt->execute(array($email,$verfiycode));

$count=$stmt->rowCount();
  if($count>0){
    printSuccess();
  }else{
    printFailure();
  }
?>