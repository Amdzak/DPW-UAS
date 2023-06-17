<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["username"];
        $pass = $_POST["password"];

        if ($user == "admin" && $pass == "admin"){
            session_start();
            $_SESSION["loggedin"] = true;

            header("Location : home.php");
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
</head>
<body>
    <?php 
        if(isset($err)){
            echo "<p>$err</p>";
        }
    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="username">Username : </label>
        <input type="text" name="username" required> <br>
        <label for="password">Password : </label>
        <input type="password" name="password" required> <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
