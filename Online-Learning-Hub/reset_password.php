<?php
@include 'config.php'; // Include your DB configuration file

if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    // Check if the token is valid and matches the email
    $select = "SELECT * FROM user WHERE email = '$email' AND reset_token = '$token'";
    $result = mysqli_query($conn, $select);
    echo $token . $email;

    if (mysqli_num_rows($result) > 0) {
        if (isset($_POST['submit'])) {
            // Get the new password
            $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));

            if ($new_password === $confirm_password) {
                // Update the password in the database and clear the reset token
                $update = "UPDATE user SET password = '$new_password', reset_token = NULL WHERE email = '$email'";
                mysqli_query($conn, $update);
                echo "Password updated successfully!";
                header("refresh:2;url=login_form.php"); // Redirect after 2 seconds
                exit(); 
            } else {
                echo "Passwords do not match!";
                header('Location: login_form.php');
            }
        }
    } else {
        echo "Invalid or expired token!";
        header('Location: login_form.php');
    }
} else {
    echo "password updeted";
    header('Location: login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .error-msg {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form action="" method="post">
        <h3>Reset Your Password</h3>

       

        <input type="password" name="new_password" required placeholder="Enter new password">
        <input type="password" name="confirm_password" required placeholder="Confirm new password">
        <input type="submit" name="submit" value="Reset Password">

    </form>
</div>

</body>
</html>
