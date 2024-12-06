<?php

// Include the database configuration file
include 'config.php';

// Check if the registration form is submitted
if (isset($_POST['submit'])) {
    // Sanitize input and hash the password
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($con, md5($_POST['cpassword']));

    // Check if the user already exists
    $select = mysqli_query($con, "SELECT * FROM `user` WHERE Email = '$email' AND Password = '$password'") or die('Query failed: ' . mysqli_error($con));

    // If user exists, show an error message
    if (mysqli_num_rows($select) > 0) {
        $message[] = 'User already exists!';
    } else {
        // Insert the new user into the database
        mysqli_query($con, "INSERT INTO `user` (Name, Email, Password) VALUES('$name', '$email', '$password')") or die('Query failed: ' . mysqli_error($con));
        $message[] = 'Registered successfully!';
        header('Location: login.php'); // Redirect to login page after successful registration
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css2/style.css">
    <style>
        input {
            text-align: center;
        }

        .message {
            background-color: #ffdddd;
            color: #d8000c;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #d8000c;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container h3 {
            margin-bottom: 20px;
        }

        .form-container input.box {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }

        .form-container input.btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
        }

        .form-container p {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
// Display any error or success messages
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
    }
}
?>

<div class="form-container">
    <form action="" method="post">
        <h3>Create a New Account</h3>
        <input type="text" name="name" required placeholder="Enter your name" class="box">
        <input type="email" name="email" required placeholder="Enter your email" class="box">
        <input type="password" name="password" required placeholder="Enter your password" class="box">
        <input type="password" name="cpassword" required placeholder="Confirm your password" class="box">
        <input type="submit" name="submit" class="btn" value="Register Account">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>

</body>
</html>
