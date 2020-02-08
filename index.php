<?php
session_start();
if (!isset($_SESSION['login'])){
  header("Location: login.php");
  exit;
}
require 'api/function.php';

$query = "SELECT * FROM device0001";
$rawdata = (query($query));
// var_dump($rawdata);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css"> <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/style.css"> <!-- File CSS -->
  <link rel="stylesheet" href="css/style2.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> <!-- Library Chart Js -->


  <title>Phore-algae - Live Now</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #188751;">
    <a class="text-light" href="index.php" style="font-size: 25px;">SpirulinaIoT</a>
    <a href="" class="text-light ml-auto"><?= $_SESSION['nama'];?></a>
    <a href="logout.php" class="text-light ml-2">Logout</a>
    <!-- <a href="logout.php" class=""></a> -->
  </nav>

  <!-- Container for main page-->
  <div class="mt-2">
    <div class="row no-gutters">
      <!-- Start of sticky sidebar-->
      <nav class="col-sm-2 border-right">
        <ul class="nav flex-column">
          <li class="nav-item active" href="#">
            <a class="nav-link" href="index.php">Live Now!<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="newchannel.php">New Channel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="history.php">History</a>
          </li>
        </ul>
      </nav>
      <!-- End of sticky sidebar -->

      <!-- Start of main page-->
      <div class="col-sm-10 pl-4">
        <!-- Baris untuk kurva pertumbuhan -->

        <h2 class="headercontainer">Live Now - Kultur Spirulina (7 Januari 2020)</h2>

        <hr>
        <div class="row dataharian">
          <div class="col-sm-12">
            <h3>Data Harian</h3>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Intensitas</h5>
                <p class="text-center" style="font-size: 50px;" id="absorbance"><?= $rawdata[count($rawdata)-1]['ints']; ?></p>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Transmitansi</h5>
                <p class="text-center" style="font-size: 50px;" id="absorbance"><?= $rawdata[count($rawdata)-1]['trans']; ?></p>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Absorbansi</h5>
                <p class="text-center" style="font-size: 50px;" id="absorbance"><?= $rawdata[count($rawdata)-1]['adso']; ?></p>
              </div>
            </div>
          </div>

        </div>

        <div class="row kurvapertumbuhan">
          <div class="col-sm-12">
            <h3>Kurva Pertumbuhan</h3>
          </div>
          <hr>

          <div class="col-sm-6">
            <canvas id="Voltase" width="400" height="200"></canvas>
          </div>

          <div class="col-sm-6">
            <canvas id="Intensitas" width="400" height="200"></canvas>
          </div>

          <div class="col-sm-6">
            <canvas id="Transmitansi" width="400" height="200"></canvas>
          </div>

          <div class="col-sm-6">
            <canvas id="Adsorbansi" width="400" height="200"></canvas>
          </div>
        </div>
        <div class="row pl-4">
          <h3>Data Masukkan Terakhir</h3>
          <hr>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Data Analog</th>
                  <th scope="col">Voltase</th>
                  <th scope="col">Intensitas</th>
                  <th scope="col">Transmitansi</th>
                  <th scope="col">Absorbansi</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 0; $i < 10; $i++) : ?>
                  <tr>
                    <th scope="row"><?php echo $i + 1; ?></td>
                    <td><?php echo $rawdata[count($rawdata) - 1 - $i]["dates"]; ?></td>
                    <td><?php echo $rawdata[count($rawdata) - 1 - $i]["times"]; ?></td>
                    <td><?php echo $rawdata[count($rawdata) - 1 - $i]["rawdata"]; ?></td>
                    <td><?php echo $rawdata[count($rawdata) - 1 - $i]["volt"]; ?></td>
                    <td><?php echo $rawdata[count($rawdata) - 1 - $i]["ints"]; ?></td>
                    <td><?php echo $rawdata[count($rawdata) - 1 - $i]["trans"]; ?></td>
                    <td><?php echo $rawdata[count($rawdata) - 1 - $i]["adso"]; ?></td>
                  </tr>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>

        </div>
        <!-- End of main page-->
      </div>

    </div>
    <footer>
      <hr>
      <p class="text-center">Copyright &copy; 2020 Afdhal Yusra. All rights reserved</p>
    </footer>

    <!-- End of main container-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="api/drawlinechart.js"></script>
    
</body>

</html>