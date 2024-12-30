<?php
//بالبداية لازم اوصل الى ملف الاتصال
include "../conectphp.php";

$email=filterRequest("email");
//sha1 هي داله لتشفير البيانات
$password=sha1($_POST['password']);
getData("users","users_email=? AND users_password=?",array($email,$password));
