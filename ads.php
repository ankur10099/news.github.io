<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP POST Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_REQUEST['pkg'])) {

        // successfully inserted into database
        $response["success"] = 1;

        $response["app_id_ad_unit_id"] = "";

        $response["banner"] = "fb";
        $response["bannermain"] = "2412724709042686_2421981888116968";

        $response["interstitial"] = "fb";
        $response["interstitialmain"] = "2412724709042686_2490975471217609";

        $response["ADMOB_INTERSTITIAL_FREQUENCY"] = 3;
        $response["message"] = "successfully";

        // echoing JSON response
        echo json_encode($response);

} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
