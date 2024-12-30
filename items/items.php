
<?php
include "../conectphp.php";
$selectCat=filterRequest("selectCat");

$userid=filterRequest("userid");

$stmt=$con->prepare("SELECT items1view.* ,1 as favorite FROM items1view INNER JOIN favorite ON favorite.favorite_items_id=items1view.items_id 
AND favorite.favorite_users_id=$userid 
WHERE categories_id=$selectCat
UNION ALL 
SELECT  items1view.*, 0 as favorite FROM items1view 
WHERE categories_id=$selectCat AND items1view.items_id not in(
SELECT items1view.items_id FROM items1view INNER JOIN favorite ON favorite.favorite_items_id=items1view.items_id 
AND favorite.favorite_users_id=$userid
)");
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
$count=$stmt->rowCount();
if ($count > 0){
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
   
}
?>