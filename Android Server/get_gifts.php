<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table
$result = mysql_query("SELECT * FROM item WHERE isGift LIKE '1' ") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["item"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        //$product["item_ID"] = $row["item_ID"];
        $product["isDish"] = $row["isDish"];
        $product["isGift"] = $row["isGift"];
        $product["Name"] = $row["Name"];
        $product["Price"] = $row["Price"];
        $product["Availability"] = $row["Availability"];
 
        // push single product into final response array
        array_push($response["item"], $product);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>