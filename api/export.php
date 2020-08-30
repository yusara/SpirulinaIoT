<?php  
require 'function.php';
if(isset($_GET['export'])){
    $deviceid = $_GET['export'];
    global $conn;
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('id', 'dates', 'times', 'rawdata', 'volt', 'adso'));  
    $query = "SELECT * from $deviceid";  
    $result = mysqli_query($conn, $query);  
    while($row = mysqli_fetch_assoc($result))  
    {  
        fputcsv($output, $row);  
    }  
    fclose($output); 
}
?> 