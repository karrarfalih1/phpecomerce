CREATE VIEW itemsview AS 
SELECT items.* ,categories.* FROM items 
INNER JOIN categories on items.items_cat=categories.categories_id


////////////////////
هذا الاستعلام  لكي اجلب العناصر المفضلة التي اختارها   صاحب الايدي 38
SELECT items1view.* FROM items1view INNER JOIN favorite ON favorite.favorite_items_id=items1view.items_id 
AND favorite.favorite_users_id=38;


/////////////هنا اضفنا حقل   لجدول ال itemsview  وهو الfavorite وقيمته واحد
SELECT items1view.* FROM items1view INNER JOIN favorite ON favorite.favorite_items_id=items1view.items_id AND
 favorite.favorite_users_id=38;

/////////////////////////////////////////////////////////////////////////
/////////////////////انشاء  جدول وهمي لاضهار المفضلة 

CREATE OR REPLACE VIEW  viewfavorite AS
SELECT favorite.*,items.*,users.users_id FROM favorite
INNER JOIN users ON users.users_id=favorite.favorite_users_id 
INNER JOIN items ON items.items_id =favorite.favorite_items_id


////////////////////cart view/////////
CREATE OR REPLACE VIEW  viewcart AS
SELECT cart.*,items.*,users.users_id FROM cart
INNER JOIN users ON users.users_id=cart.cart_users_id 
INNER JOIN items ON items.items_id =cart.cart_items_id