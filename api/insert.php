<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require 'function.php';
$response = array();
 

if (isset($_GET['dates']) && isset($_GET['times']) && isset($_GET['rawdata']) && 
    isset($_GET['volt']) && isset($_GET['ints']) && 
    isset($_GET['trans']) && isset($_GET['adso'])) {
 
    $dates = $_GET['dates'];
    $times = $_GET['times'];
    $rawdata = $_GET['rawdata'];
    $volt = $_GET['volt'];
    $ints = $_GET['ints'];
    $trans = $_GET['trans'];
    $adso = $_GET['adso'];  
    
    $query = "INSERT INTO device0001(dates,times,rawdata,volt,ints,trans,adso) 
                VALUES('$dates','$times','$rawdata','$volt','$ints','$trans','$adso')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Weather successfully created.";
 
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
 
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    echo json_encode($response);
}
?>