<?php
// Include the database configuration file
include 'config.php';

// Start a session
session_start();

// Check if the login form is submitted
if (isset($_POST['submit'])) {
    // Sanitize input and hash the password
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, md5($_POST['password']));

    // Query to check if the user exists
    $query = "SELECT * FROM `user` WHERE Email = '$email' AND Password = '$password'";
    $select = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));

    // Check if any rows match
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['ID']; // Save user ID in session
        header('Location: index2.php'); // Redirect to homepage
        exit();
    } else {
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="css2/style.css">
    <style>
        /* Add some inline styling */
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
// Display error messages
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
    }
}
?>
    
<div class="form-container">
    <form action="" method="post">
        <h3>Login</h3>
        <input type="email" name="email" required placeholder="Enter your email" class="box">
        <input type="password" name="password" required placeholder="Enter your password" class="box">
        <input type="submit" name="submit" class="btn" value="Login">
        <p>Don't have an account? <a href="register.php">Create one</a></p>
    </form>
</div>

</body>
</html>