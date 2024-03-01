<?php
// Start the session
session_start();

// Check if user is logged in as admin, if not, redirect to login page
//if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//    header("Location: login.php");
//    exit;
//}

// Include any necessary configuration or database connection files
// Include 'config.php' or 'db_connection.php' here if needed

// Process any form submissions if applicable

// Display HTML content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <style>
        body {
            
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #007bff;
        }
        label {
            font-weight: bold;
        }
        input[type="radio"], input[type="checkbox"] {
            margin-right: 5px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> Settings Page</h1><br>
        <p style="font-size:25px;"><b>Welcome, <?php echo $_SESSION['username']; ?>!</b></p>
        <h2>Theme</h2>
        <form action="change_theme.php" method="post">
            <input type="radio" id="theme_light" name="theme" value="light" <?php echo isset($_SESSION['theme']) && $_SESSION['theme'] === 'light' ? 'checked' : ''; ?>>
            <label for="theme_light">Light</label><br>
            <input type="radio" id="theme_dark" name="theme" value="dark" <?php echo isset($_SESSION['theme']) && $_SESSION['theme'] === 'dark' ? 'checked' : ''; ?>>
            <label for="theme_dark">Dark</label><br>
        </form>
        <h2>Notifications</h2>
        <form action="#" method="post">
            <input type="checkbox" id="notifications" name="notifications" <?php echo isset($_SESSION['notifications']) && $_SESSION['notifications'] === true ? 'checked' : ''; ?>>
            <label for="notifications">Enable Notification</label><br>
        </form><br><br>
        <form action="#" method="post">
            <button type="submit">Reset Settings</button>
        </form>
        <a href="log_out.php">Logout</a>
    </div>
</body>
</html>
