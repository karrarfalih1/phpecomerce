<?php
include "../conectphp.php";
$favorite_users_id=filterRequest("favorite_users_id");
$favorite_items_id=filterRequest("favorite_items_id");
    $data=array(
        "favorite_users_id"=>$favorite_users_id,
        "favorite_items_id"=>$favorite_items_id,
     );
    insertData("favorite", $data,);



?>