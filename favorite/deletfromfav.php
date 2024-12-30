<?php
include "../conectphp.php";
$favorite=filterRequest("favorite");
deleteData("favorite","favorite_id=$favorite");
?>