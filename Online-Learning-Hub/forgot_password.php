<?php
@include 'config.php'; // Include your DB configuration file

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = md5($_POST['new_password']); // Hash the new password

    // Check if the email exists in the database
    $select = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        // Update the password for the specified email
        $update = "UPDATE user_form SET password = '$new_password' WHERE email = '$email'";
        if (mysqli_query($conn, $update)) {
            echo "Password updated successfully!";
            echo "Password updated successfully!";
                header("refresh:2;url=login_form.php"); // Redirect after 2 seconds
                exit(); 
        } else {
            echo "Failed to update password. Please try again.";
        }
    } else {
        echo "No account found with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <style>
        /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body styling */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f0f2f5;
}

/* Form container styling */
form {
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Heading styling */
h3 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

/* Input fields styling */
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Button styling */
input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

        </style>
</head>
<body>
    <form action="" method="post">
        <h3>Forgot Password</h3>
        <input type="email" name="email" required placeholder="Enter your registered email">
        <input type="password" name="new_password" required placeholder="Enter new password">
        <input type="submit" name="submit" value="Reset Password">
    </form>
</body>
</html>
