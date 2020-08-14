<?php
header('Content-Type: application/json');
/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();


// include db connect class
// require_once __DIR__ . '/db_connect.php';

// connecting to db
// $db = new DB_CONNECT();
// $conn = $db->connect();

$con=mysqli_connect("localhost","free4ee3_rajan","65336533","free4ee3_rajan6533");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$name="";
// check for post data
if (isset($_GET["name"])) {
    $name = $_GET['name'];


// get all rajan from products table
// and no=291
$result = mysqli_query($con,"SELECT name, banner, bannerid, interstrial, interstrialid, time FROM admobfb where name=$name limit 1") or die(mysql_error());

// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // rajan node
    $response["rajanr"] = array();
    
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        // temp user array
        $rajan = array();        
        $rajan["name"] = $row["name"];
        $rajan["banner"] = $row["banner"];
        $rajan["bannerid"] = $row["bannerid"];
        $rajan["interstrial"] = $row["interstrial"];
        $rajan["interstrialid"] = $row["interstrialid"];
        $rajan["time"] = $row["time"];


        // push single rajan into final response array
        array_push($response["rajanr"], $rajan);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No rajan found";

    // echo no users JSON
    echo json_encode($response);
}
mysqli_close($con);
}
?>
