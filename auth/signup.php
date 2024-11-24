<?php
//بالبداية لازم اوصل الى ملف الاتصال
include "../conectphp.php";

$username=filterRequest("username");
//sha1 هي داله لتشفير البيانات
$password=sha1("password");
$email=filterRequest("email");
$phone=filterRequest("phone");
$verfiycode="0";
//يجب ان نتحقق  من ان الايميل او رقم الهاتف  غير موجود اصلا حتى لا يتكرر
$stmt=$con->prepare("SELECT * FROM users WHERE users_email=? OR users_phone=?");

$stmt->execute(array($email,$phone));
//حتى نعرف اذا الكود الفوك اشتغل لو لا
$count=$stmt->rowCount();
//اذا كان اكب رمن صفر هذا يدل ان الايميل او رقم الهاتف موجودين بالفعل  لهذا يجب ان يستخدم خيرهن
if($count>0){
    printFailure("PHONE OR EMAIL IS ELRADY IS USED");
}else{
    //بعد ان تحققنا ان  الايميل اور رقم الهاتف فعلا جديد الان  نضيف معلوماته 
    $data=array(
        //على اليسار يجب ان نكتب  الاسامي مثل ما موجودة  بقاهدة البيانات
        "users_name"=>$username,
        "users_password"=>$password,
        "users_email"=>$email,
        "users_phone"=>$phone,
        "users_verfiycode"=>"0",

    );
    //هذه داله الاضافه موجوده في  ملف الفنكشن  يجب ان نكتب فيها اسم الحقل و البيانات
    insertData("users",$data) ;
}
