<?php include "db.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login form</h2>
    <form action="" method="post">
        <input type="email" name="email" id="" placeholder="enter email">
        <br>
        <br>
        <input type="password" name="password" id="" placeholder="enter password">

        <br>
        <br>
        <input type="submit" value="Register" name="submit">
    </form>

    <?php
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        $pass_hash = $user['password'];
        $verify_pass = password_verify($password, $pass_hash);

        //login the user and save the session
        if($verify_pass){
            session_start();
            $_SESSION['username'] = $user['username'];
            echo "Login successful. Welcome " . $_SESSION['username'];
            echo "<script> window.open('dashboard.php', '_self') </script>";
        } else {
            echo "Invalid email or password.";
        }
    }
    ?>
</body>
</html>