<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username already exists
    $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $check->execute([$username]);
    if ($check->fetch()) {
        echo "Username already taken.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

     <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #f7e1ff, #e7d6ff);
            height: 100vh;
        }

        h1 {
            position: absolute;
            top: 20px;
            left: 30px;
            color: #4c0070;
            font-size: 26px;
        }

        form {
            max-width: 300px;
            margin: 120px auto;
            padding: 30px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(128, 0, 128, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #4c0070;
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #d3b3ff;
            border-radius: 8px;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #b065ff, #d09eff);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: linear-gradient(to right, #a04eff, #c98fff);
        }
    </style>
     
  
</head>
<body>
    <h1>Register</h1>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
