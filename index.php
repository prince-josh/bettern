<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" id="" placeholder="Enter username" required>
        <br>
        <br>
        <input type="email" name="email" id="" placeholder="Enter email" required>
        <br>
        <br>
        <input type="password" name="password" id="" placeholder="Enter password" required>
        <br>
        <br>
        <input type="submit" value="Register" name="submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate inputs
        if (empty($username) || empty($email) || empty($password)) {
            echo "All fields are required.";
            exit();
        }

        // Hash the password
        $pass_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $pass_hash);

            if (mysqli_stmt_execute($stmt)) {
                echo "User registered successfully.";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    }
    ?>

</body>
</html>
