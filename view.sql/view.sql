-- the first table(categories+items)

-- CREATE VIEW itemsview AS
-- SELECT items.* , categories.* FROM items
-- INNER JOIN categories ON categories.categories_id = items.items_cat

------------------------------------------------------------------------------

-- new table(categories+items) with favorit for "items page"
CREATE OR REPLACE VIEW itemsview AS
SELECT  items1view.*,1 as favorit FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid =16
UNION ALL 
SELECT *,0 as favorit FROM items1view 
WHERE items_id != (SELECT  items1view.items_id FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid =16 )

-------------------------- myfavoriteview   -----------------------------

CREATE OR REPLACE VIEW myfavoriteview AS
SELECT favorite.* , items.*, users.users_id FROM favorite
INNER JOIN users ON users.users_id = favorite.favorite_usersid
INNER JOIN items ON items.items_id = favorite.favorite_itemsid

-------------------------- cartview   -----------------------------

CREATE OR REPLACE VIEW cartview as
SELECT SUM(items.items_price - items.items_price * items_discount /100) as itemsprice , COUNT(cart.cart_itemsid) as countitems ,items.*,cart.* FROM cart
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_orders =0
GROUP BY cart.cart_itemsid ,cart.cart_userid ,cart.cart_orders

-------------------------- ordersview   -----------------------------

CREATE OR REPLACE VIEW ordersview as
SELECT  orders.* , address.*  FROM orders
LEFT JOIN address ON address.address_id = orders.orders_address

-------------------------- ordersdetailsview   -----------------------------

CREATE OR REPLACE VIEW ordersdetailsview as
SELECT SUM(items.items_price-items.items_price*items_discount /100) as itemsprice, COUNT(cart.cart_itemsid) as countitems,items.*,cart.* FROM cart
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_orders !=0
GROUP BY cart.cart_itemsid ,cart.cart_userid ,cart.cart_orders

-------------------------- itemstopselling   -----------------------------
CREATE OR REPLACE VIEW itemstopselling as
SELECT COUNT(cart_itemsid) as countitems , cart.* ,items.*,(items_price - (items_price *items_discount	/100 )) as itempricediscount FROM cart
INNER JOIN items ON cart.cart_itemsid=items.items_id
WHERE cart_orders !=0
GROUP BY cart_itemsid