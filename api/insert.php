<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['dates']) && isset($_GET['times']) && 
    isset($_GET['volt']) && isset($_GET['ints']) && 
    isset($_GET['trans']) && isset($_GET['adso'])) {
 
    $dates = $_GET['dates'];
    $times = $_GET['times'];
    $volt = $_GET['volt'];
    $ints = $_GET['ints'];
    $trans = $_GET['trans'];
    $adso = $_GET['adso'];
    
 
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");
 
    // Connecting to database 
    $db = new DB_CONNECT();
 
    // Fire SQL query to insert data in weather
    $result = mysql_query("INSERT INTO spirulina(dates,times,volt,ints,trans,adso) VALUES('$dates','$times','$volt','$ints','$trans','$adso')");
 
    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "Weather successfully created.";
 
        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // Show JSON response
    echo json_encode($response);
}
?>