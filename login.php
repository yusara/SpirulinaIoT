<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
$conn = mysqli_connect("localhost", "root", "", "user1");
// $conn = mysqli_connect("localhost", "id12045401_belajar03", "75648988ipa", "id12045401_belajar03");
if (isset($_POST['masuk'])) {

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $result = mysqli_query($conn, "SELECT * FROM useraccount WHERE email = '$email'");
    
    if (mysqli_num_rows($result) === 1) {
        // cek password
        
        $row = mysqli_fetch_assoc($result);
        $nama = $row["username"];
        $profile_picture = $row["profile_picture"];
        if ($pass == $row["password"]) {
            //set session
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $nama;            
            header("Location: index.php");
            exit;
        }
        else{
            echo 'Password salah';
        }
    }
    else{
        $error = true;
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-4 border-dark">
                <h2 class="text-center">Login</h2>
                <form action="" method="post">
                    <div class="row form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="row form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="pass" id="pass">
                    </div>
                    <div class="row">
                        <p>Belum punya akun? <a href="signup.php">Daftar</a></p>
                    </div>
                    <button type="submit" name="masuk" class="btn btn-primary btn-block">Masuk</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>