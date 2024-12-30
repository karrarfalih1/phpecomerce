<?php
include "../conectphp.php";
$userid=filterRequest("userid");
getAllData('viewfavorite','favorite_users_id=?',array($userid));

?>