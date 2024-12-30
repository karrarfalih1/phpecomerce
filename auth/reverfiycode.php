<?php

include "../conectphp.php";
$email=filterRequest("email");
$verfiycode=rand(10000,99999);

$stmt=$con->prepare("SELECT * from users WHERE users_email=?");
$stmt->execute(array($email));
$count=$stmt->rowCount();
if($count>0){
    $data=["users_verfiycode"=>$verfiycode];
    $where="users_email=?";
    $whereValues = [$email];
    updateData("users", $data, $where, $whereValues,false);
    sendEmail($email,"Verfiy Code Ecommerce","Verfiy Code $verfiycode");
    printSuccess();
}else{
printFailure($message="none");
}
?>