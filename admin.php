<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = htmlspecialchars($_POST["username"]);
        $pass = htmlspecialchars($_POST["password"]);

        if ($user == "admin" ){
        if ($user == "admin" && $pass == "admin"){            
            session_start();
            $_SESSION["loggedin"] = true;
            header('location:home.php');
            
            header("Location:home.php");
            exit;
        } else {
            $err = "USERNAME DAN PASSWORD SALAH";
        }
    }     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bd.css">
</head>
<body class="bg-dark"> 
<?php 
    if(isset($err)){
        echo "<script> alert('USERNAME DAN PASSWORD SALAH') </script>";
    }
?>
    <div class="container col-4 bd child">
        <h2 align="center" class="mt-5 text-light">Admin Login</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label text-light">Username</label>
                <input type="text" name="username" class="form-control">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
            <label for="password" class="form-label text-light">Password</label>
            <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label text-light" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Submit</button>
        </form>

    </div>
</body>
</html>
<!-- 
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="username">Username : </label>
    <input type="text" name="username" required> <br>
    <label for="password">Password : </label>
    <input type="password" name="password" required> <br>
    <input type="submit" value="Login">
</form> -->
