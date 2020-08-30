<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    /*Program ini berisi kode untuk mengubah data dari database yang masih mentah
    menjadi data rata per hari*/  
    require "function.php";
    
    $data = "SELECT * FROM device0001";
    $result = mysqli_query($conn, $data);
    $rows = [];
    $spirulina = [];
    $tanggal = [];
    $tgl = [];
    $spl = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
        $spirulina["dates"] = $row["dates"];
        $spirulina["adso"] = $row["adso"];
        $tanggal = $row["dates"];
        array_push($tgl, $tanggal);
        array_push($spl, $spirulina);
    }
    echo json_encode($spl);

    //Array untuk tanggal
    // $datesarray = array();
    // $datesarray = array_values(array_unique($tgl));

    // var_dump($datesarray);
    // echo "<br>";

    // $voltarray = array();
    // for ($j = 0; $j < count($datesarray); $j++) {
    //     $sum = 0;
    //     $it = 0;
    //     for ($i = 0; $i <= count($spl) - 1; $i++) {
    //         if ($datesarray[$j] == $spl[$i]["dates"]) {
    //             $sum += $spl[$i]["adso"];
    //             $it += 1;
    //         } else {
    //             continue;
    //         }
    //     }
    //     $average = $sum / $it;
    //     $avg = number_format($average, 5, '.', '');
    //     array_push($voltarray, $avg);
    // }
    // // var_dump($voltarray);
    // // echo "<br>";

    // $truearray = array();
    // for ($k = 0; $k < count($datesarray); $k++) {
    //     $momentaryarray = array();
    //     $momentaryarray["dates"] = $datesarray[$k];
    //     $momentaryarray["adso"] = $voltarray[$k];
    //     array_push($truearray, $momentaryarray);
    // }
    // var_dump($truearray);
    // echo json_encode($truearray);

