<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Video | Educational Hub</title>
    <style>
        /* CSS styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .form-container:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #28a745;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.2s ease;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
            outline: none;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        .form-group button {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .form-group button:active {
            background-color: #1e7e34;
        }
        /* Responsive Design */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }
            .form-group button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $videoRequest = htmlspecialchars($_POST['videoRequest']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);

    // Data to write into file
    $data = "Name: $name\nVideo Request: $videoRequest\nEmail: $email\nFeedback: $feedback\n\n";

    // Write data to video_requests.txt file
    $file = fopen("video_requests.txt", "a");
    if ($file) {
        fwrite($file, $data);
        fclose($file);
        echo "<div class='alert alert-success mt-3'>Your request has been submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error submitting your request. Please try again.</div>";
    }
}
?>

<div class="form-container">
    <h2>Request a Video</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="videoRequest">Video Request:</label>
            <input type="text" id="videoRequest" name="videoRequest" placeholder="What video would you like to request?" required>
        </div>
        <div class="form-group">
            <label for="email">Contact Email:</label>
            <input type="email" id="email" name="email" placeholder="Your email address" required>
        </div>
        <div class="form-group">
            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" placeholder="Provide any additional feedback" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Submit Request</button>
        </div>
    </form>
</div>

</body>
</html>
