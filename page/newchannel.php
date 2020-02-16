<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require '../api/function.php';


if (isset($_POST['masuk'])) {
    $user = $_SESSION['nama'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deviceid = $_POST['deviceid'];

    $query = "INSERT INTO channels VALUES ('','$user','$deviceid','$title','$description')";
    mysqli_query($conn,$query);
    echo '<script>
    alert("Success to add data");
    </script>';
}
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
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #188751;">
        <a class="text-light" href="../index.php" style="font-size: 25px;">SpirulinaIoT</a>
        <a href="" class="text-light ml-auto"><?= $_SESSION['nama']; ?></a>
        <a href="../logout.php" class="text-light ml-2">Logout</a>
        <!-- <a href="logout.php" class=""></a> -->
    </nav>

    <!-- Container for main page-->
    <div class="pt-2 pr-5 pr-2">
        <div class="row no-gutters">
            <!-- Start of sticky sidebar-->
            <nav class="col-sm-2 border-right">
                <ul class="nav flex-column">
                    <li class="nav-item active" href="#">
                        <a class="nav-link" href="../index.php">Live Now!<span class="sr-only">(current)</span></a>
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

                <h2 class="headercontainer">Add New Channel</h2>

                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Channel Title</label><br>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label><br>
                        <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="deviceid">Device ID</label><br>
                        <input type="text" name="deviceid" class="form-control" id="deviceid">
                    </div>

                    <button type="submit" name="masuk" class="btn btn-primary mt-2">Submit</button>
                </form>




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

</body>

</html>