<?php

include "../conectphp.php";
//هذا ايميل الشخص الي راح نحصل علي من الفرونت ايند وهوة نفسة الي دخله المستخدم
$email =filterRequest("email");

//هذا الكود الي كتبه المستخدم
$verfiycode=filterRequest("verfiycode");

$stmt=$con->prepare("SELECT * FROM users WHERE `users_email` =? AND users_verfiycode =?");

$stmt->execute(array($email,$verfiycode));

$count=$stmt->rowCount();
  
//اذا كان اكب رمن صفر هذا يدل ان الايميل او رقم الهاتف موجودين بالفعل  لهذا يجب ان يستخدم خيرهن
if($count>0){
  
  $data=["users_approve"=>"1"];
  $where="users_email=?";
  $whereValues = [$email];
  updateData("users", $data, $where, $whereValues);
 // printSuccess();
}else{
printFailure("verfiy code not correct2");
}
?>