<?php


session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require '../api/function.php';
$user = $_SESSION['nama'];
$query = "SELECT * FROM device_table WHERE user = '$user' AND channel_status = 'ACTIVE'";
$livechannel = (query($query));

$user = $_SESSION['nama'];
$query = "SELECT * FROM device_table WHERE user = '$user'";
$history = (query($query));
// var_dump($history);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/style.css"> <!-- File CSS -->
    <link rel="stylesheet" href="../css/style2.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> <!-- Library Chart Js -->


    <title>Phore-algae - Live Now</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top nav-style">
        <ul class="navbar-nav nav-style mr-auto">
        <li class="nav-item active">
            <a class="text-light navbar-brand" href="index.php" style="font-size: 20px;">SpirulinaIoT</a>
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
            <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-ex><?= $_SESSION['nama']; ?></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="">My Profile</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
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
                        
                        <a class="nav-link dropdown-btn dropdown-toggle sidebar-style" href="../index.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Live Now!
                        </a>
                        <div class="dropdown-container">
                            <?php foreach($livechannel as $lvn):?>
                                <a href="culture/<?= $lvn['deviceid'];?>.php" class="sidebar-style"><?= $lvn['channelname'] ?></a>
                            <?php endforeach;?>
                        </div>
                    </li>
                    <li></li>
                    <li class="nav-item sidebar-style">
                        <a class="nav-link" href="newchannel.php">New Channel</a>
                    </li>
                    <li class="nav-item sidebar-style">
                        <a class="nav-link" href="history.php">History</a>
                    </li>
                </ul>
            </nav>
            <!-- End of sticky sidebar -->

            <!-- Start of main page-->
            <div class="col-sm-10 pl-4">
                <!-- Baris untuk kurva pertumbuhan -->
                <h2>History</h2>
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                <?php $i = 1; foreach ($history as $id => $hst) : ?>
                                    <tr>
                                        <td scope="row"><?= $i; ?></td>
                                        <td width="200"><?=  $hst["channelname"]; ?></td>
                                        <td width="400"><?=  $hst["description"]; ?></td>
                                        <td><?=  $hst["startdate"]; ?></td>
                                        <td><?=  $hst["enddate"]; ?></td>
                                        <td><?=  $hst["channel_status"]; ?></td>
                                        <td><a href="">Download data</a></td>
                                    </tr>
                                <?php $i++; endforeach; ?>
                            </thead>
                        </table>

                    </div>

                </div>
                <!-- End of main page-->
            </div>

        </div>
        <footer class="fixed-bottom">
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