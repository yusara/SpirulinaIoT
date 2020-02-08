<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Creating Array for JSON response
$response = array();
 
// Include data base connect class
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/dbconnect.php");
 // Connecting to database 
$db = new DB_CONNECT();	
 
 // Fire SQL query to get all data from spirulina
$result = mysql_query("SELECT *FROM spirulina") or die(mysql_error());
 
// Check for succesfull execution of query and no results found
if (mysql_num_rows($result) > 0) {
    
	// Storing the returned array in response
    $response["spirulina"] = array();
 
	// While loop to store all the returned response in variable
    while ($row = mysql_fetch_array($result)) {
        // voltseroary user array
        $spirulina = array();
        $spirulina["id"] = $row["id"];
        $spirulina["dates"] = $row["dates"];
		$spirulina["times"] = $row["times"];
        $spirulina["volt"] = $row["volt"];
		$spirulina["ints"] = $row["ints"];
        $spirulina["trans"] = $row["trans"];
		$spirulina["adso"] = $row["adso"];
        // Push all the items 
        array_push($response["spirulina"], $spirulina);
    }
    // On success
    $response["success"] = 1;
 
    // Show JSON response
    echo json_encode($response);
}	
else 
{
    // If no data is found
	$response["success"] = 0;
    $response["message"] = "No data on spirulina found";
 
    // Show JSON response
    echo json_encode($response);
}
?>