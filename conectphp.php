
<?php
//في هذا السطر عرفت الهوست وعرفت اسم قاعدة البيانات الي انا اريد ارتبط بيها 
$dsn = "mysql:host=karrar.rf.gd;dbname=if0_37777222_ecommerce";
//يعني يستطيع الوصول لكل البيانات 
$user = "root";
// خليت كلمة المرور فارغة 
$pass = "";

//حته اخلي يدعم اللغة العربية
$option = array(
   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
);
$countrowinpage = 9;
//كزد الاتصال
try {
   $con = new PDO($dsn, $user, $pass, $option);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
   header("Access-Control-Allow-Methods: POST, OPTIONS , GET");
   include "functions.php";
   if (!isset($notAuth)) {
       checkAuthenticate();
   }
} catch (PDOException $e) {
   echo $e->getMessage();
}