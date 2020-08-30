<?php
session_start();
if (!isset($_SESSION["login"])) {
header("Location: /spirulinaiot/page/login.php");
exit;
}
require "../../api/function.php";
$user = $_SESSION["nama"];
$page_create = "dvc0000002";

//livechannel sidebar
$status = "ACTIVE";
$query1 = "SELECT * FROM device_table WHERE user = \"$user\" AND channel_status = \"$status\"";
$livechannel = (query($query1));
// var_dump($livechannel);

$idquery = "SELECT * FROM device_table WHERE deviceid LIKE \"$page_create\"";
$channelid = query($idquery);
// var_dump($channelid);

$query2 = "SELECT * FROM $page_create";
$rawdata = query($query2);
// var_dump($rawdata);
?>

<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="../../css/bootstrap.css"> <!-- Bootstrap CSS -->
<link rel="stylesheet" href="../../css/style.css"> <!-- File CSS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> <!-- Library Chart Js -->


<title>Phore-algae -  Live Now</title>
</head>

<body>
<nav class="navbar navbar-expand-lg sticky-top nav-style">
    <ul class="navbar-nav nav-style mr-auto">
        <li class="nav-item active">
            <a class="text-light navbar-brand" href="../../index.php" style="font-size: 20px;">SpirulinaIoT</a>
        </li>
    <ul class="ml-3 navbar-nav nav-style">
        <li class="nav-item">
            <a href="" class="text-light nav nav-link">About</a>
        </li>
        <li>
            <a href="" class="text-light nav nav-link">Blog</a>
        </li>
        <li>
            <a href="" class="text-light nav nav-link">Contact Us</a>
        </li>
    </ul>
    </ul>
    <ul class="navbar-nav nav-style">
        <li class="nav-item dropdown">
            <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-ex><?= $_SESSION["nama"]; ?></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="">My Profile</a>
            <a class="dropdown-item" href="../../logout.php">Logout</a>
            </div>
        </li>
    </ul>
</nav>

<!-- Container for main page-->
<div class="pr-5 pr-2">
    <div class="row no-gutters">
    <!-- Start of sticky sidebar-->
    <nav class="col-sm-2 border-right">
        <ul class="sidenav nav flex-column">
            <li class="nav-item active dropdown" href="#">
                <!-- <a class="nav-link" href="../index.php">Live Now!</a>  -->
                
                <a class="nav-link dropdown-btn dropdown-toggle sidebar-style" href="../../index.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Live Now!
                </a>
                <div class="dropdown-container">
                    <?php foreach($livechannel as $lvn):?>
                        <a href="<?= $lvn["deviceid"];?>.php" class="sidebar-style"><?= $lvn["channelname"] ?></a>
                    <?php endforeach;?>
                </div>
            </li>
            
            <li class="nav-item sidebar-style">
                <a class="nav-link" href="../newchannel.php">New Channel</a>
            </li>
            <li class="nav-item sidebar-style">
                <a class="nav-link" href="../history.php">History</a>
            </li>
        </ul>
    </nav>
    <!-- End of sticky sidebar -->

    <!-- Start of main page-->
    <div class="col-sm-10 pl-4 mt-3">
        <!-- Baris untuk kurva pertumbuhan -->

        <h2 class="headercontainer">Live Now | <?= $channelid[0]["channelname"];?></h2>

        <hr>
        <div class="row dataharian">
        <div class="col-sm-12">
            <h3>Live Data</h3>
        </div>
        <div class="col-sm-4">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sensor Signal</h5>
                <p class="text-center" style="font-size: 50px;" id="absorbance">
                    <?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["rawdata"]; }?>
                </p>
            </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Voltage(mV)</h5>
                <p class="text-center" style="font-size: 50px;" id="absorbance">
                    <?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["volt"]; }?>
                </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Absorbance</h5>
                <p class="text-center" style="font-size: 50px;" id="absorbance">
                    <?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["adso"]; }?>
                </p>
            </div>
            </div>
        </div>

        </div>

        <div class="row kurvapertumbuhan mt-3">
        <div class="col">
            <h3>Growth Graph</h3>
        </div>
        </div>
        <div class="row kurvapertumbuhan text-center">
        <div class="col">
        <p align="center" style="font-size: 32pt;">
            <?php if(empty($rawdata)) :?>
                No Data Available    
            <?php else :?>
                <canvas id="Absorbance" width="200" height="100"></canvas>
            <?php endif;?>
        </p>
        </div>
        </div>
        <div class="row pl-4 mt-3">
        <h3>Latest Data</h3>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Sensor Signal</th>
                <th scope="col">Voltage</th>
                <th scope="col">Absorbance</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 10; $i++) : ?>
                <tr>
                    <td scope="row"><?php echo $i + 1; ?></td>
                    <td><?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["dates"]; }?></td>
                    <td><?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["times"]; }?></td>
                    <td><?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["rawdata"]; }?></td>
                    <td><?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["volt"]; }?></td>
                    <td><?php if(empty($rawdata)){ echo "No data"; } else { echo $rawdata[count($rawdata) - 1]["adso"]; }?></td>
                </tr>
                <?php endfor; ?>
            </tbody>
            </table>
        </div>

        </div>
        
        <!-- End of main page-->
    </div>
</div>

<footer class="">
    <p class="mt-3 text-center">Copyright &copy; 2020 <a href="https://www.linkedin.com/in/afdhal-yusra-590088113">Afdhal Yusra</a>. All rights reserved</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- <script type="text/javascript" src="api/drawlinechart.js"></script> -->
<script>
  var data = "<?= $page_create;?>";
  // var data = "device0003";
  // console.log(data);
  chartAbsorbance(data);

  async function chartAbsorbance(data){
    await getdata(data);

    var ctx = document.getElementById("Absorbance").getContext("2d");
    var myChart = new Chart(ctx, {
    type: "line",
    data: { 
    labels: jsarray, 
    datasets: [{
        label: "Kurva Absorbansi", 
        data: jsdata,              
        backgroundColor: "rgba( 255,99,132,5)",
        borderColor: "rgba(255, 159, 64, 1)",
        borderWidth: 3,
        fill:false
    }]
    },
    options: {
    scales: {
        yAxes: [{
        ticks: {
        beginAtZero: true
        }
        }]
    }
    }
    });
}

async function getdata(data){
    const url = "../../api/graphdata.php?deviceid="+data;
    console.log(url);
    const response = await fetch(url);
    const jsondata = await response.json();

    jsarray = [];
    jsdata = [];

    for (let i= 0; i < Object.keys(jsondata).length; i++) {
            jsarray.push(jsondata[i]["dates"]);
            jsdata.push(jsondata[i]["adso"]);
            // console.log(jsarray);
    }

    console.log(jsarray);
    console.log(jsdata);
}
</script>

</body>

</html>