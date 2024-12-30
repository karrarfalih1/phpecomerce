<?php

// ==========================================================
//  Copyright Reserved Wael Wael Abo Hamza (Course Ecommerce)
// ==========================================================

define("MB", 1048576);

function filterRequest($requestname)
{
  return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null,$json=true)
{
    global $con;
    $data = array();
    if($where==null){
        $stmt = $con->prepare("SELECT  * FROM $table");
    }else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json==true){
        if ($count > 0){
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
            return $count;
        }
    }else{
    if($count>0){
        return $data;
    }else{

    }return json_encode(array("status" => "failure"));
    }
    
}
function getData($table, $where = null, $values = null)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    return $count;
}
//داله لاضافه البيانات
function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
  }
    return $count;
}


function updateData($table, $data, $where, $whereValues = [], $json = true)
{
    global $con;
    try {
        $cols = [];
        $vals = [];

        // إعداد الأعمدة والقيم
        foreach ($data as $key => $val) {
            $cols[] = "`$key` = ?";
            $vals[] = $val;
        }

        // إنشاء SQL
        $sql = "UPDATE `$table` SET " . implode(',', $cols) . " WHERE $where";

        // دمج القيم مع قيم الشرط
        $allValues = array_merge($vals, $whereValues);

        // إعداد الاستعلام
        $stmt = $con->prepare($sql);

        // تنفيذ الاستعلام
        $stmt->execute($allValues);

        $count = $stmt->rowCount();

        if ($json) {
            echo json_encode(["status" => $count > 0 ? "success" : "failure"]);
        }

        return $count;
    } catch (PDOException $e) {
        if ($json) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        return false;
    }
}


function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($imageRequest)
{
  global $msgError;
  $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
  $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
  $imagesize  = $_FILES[$imageRequest]['size'];
  $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
  $strToArray = explode(".", $imagename);
  $ext        = end($strToArray);
  $ext        = strtolower($ext);

  if (!empty($imagename) && !in_array($ext, $allowExt)) {
    $msgError = "EXT";
  }
  if ($imagesize > 2 * MB) {
    $msgError = "size";
  }
  if (empty($msgError)) {
    move_uploaded_file($imagetmp,  "../upload/" . $imagename);
    return $imagename;
  } else {
    return "fail";
  }
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "karrar" ||  $_SERVER['PHP_AUTH_PW'] != "karrar2001") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }
/////////داله لتطبع لنا اذا حدث خطا 



    // End 
}
function printFailure($message="none"){
    print_r(  json_encode(array("status"=>"failure","message"=>$message)));
  }
  
  /////////داله لتطبع لنا اذا الامور تمام ا 
  
  function printSuccess(){
      echo  json_encode(array("status"=>"success"));
    }

function sendEmail($to,$title,$body){
  $header="From: karrar171320@gmail.com "."\n"."CC: karrarleagle512Gmail.com";
//داله جاهزة لارسال البريد الالكتروني
mail($to,$title,$body,$header);
//echo "success send Email";
    }