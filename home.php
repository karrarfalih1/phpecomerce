<?php
include "conectphp.php";
$alldata=array();
$alldata['status']='success';
$catergories=getAllData("categories", null,null,false);
$alldata['categories']=$catergories;

//في الصفحة الرئيسية اريد ان اجلب فقط العناصر التي بها خصم 
$items=getAllData("items1view", "items_discount !=0",null,false);
                   
$alldata['items']=$items;
echo json_encode($alldata);
?>