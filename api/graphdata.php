<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $conn = mysqli_connect("localhost", "root", "" , "spirulinaiot");
    // $data = "SELECT * FROM device0003";
    $device = $_GET['deviceid'];
    // var_dump($device);
    // $data = "SELECT * FROM device0003";
    $data = "SELECT * FROM $device";
    $result = mysqli_query($conn, $data);
    
    
    $rows = [];
    $spirulina = [];
    $tanggal = [];
    $tgl = [];
    $spl = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
        $spirulina["dates"] = $row["dates"];
        $spirulina["rawdata"] = $row["rawdata"];
        $tanggal = $row["dates"];
        array_push($tgl, $tanggal);
        array_push($spl, $spirulina);
    }
    
    $datesarray = array();
    $datesarray = array_values(array_unique($tgl));

    $voltarray = array();
    for ($j = 0; $j < count($datesarray); $j++) {
        $sum = 0;
        $it = 0;
        for ($i = 0; $i <= count($spl) - 1; $i++) {
            if ($datesarray[$j] == $spl[$i]["dates"]) {
                $sum += $spl[$i]["rawdata"];
                $it += 1;
            } else {
                continue;
            }
        }
        $average = $sum / $it;
        $avg = number_format($average, 3, '.', '');
        $absorbance = log10(32767/$avg);
        $abs = number_format($absorbance, 3, '.', '');
        $fitdata = (4501.4*($absorbance**3)) - (3629.3*($absorbance**2)) + (977.01*$absorbance) - 87.468;
        $fit = number_format($fitdata, 3, '.', '');
        array_push($voltarray, $fit);
    }

    $truearray = array();
    for ($k = 0; $k < count($datesarray); $k++) {
        $momentaryarray = array();
        $momentaryarray["dates"] = $datesarray[$k];
        $momentaryarray["adso"] = $voltarray[$k];
        array_push($truearray, $momentaryarray);
    }
    echo json_encode($truearray);

