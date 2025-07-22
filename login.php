<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #f3f0f9;
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            color:#3a0c5e;    
        }
        form {
            width: 300px;
            margin:100px auto;
            padding:25px;
            background:#ffffff;
            border-radius:12px;
            box-shadow: 0 0 15px rgba(106,13,173,0.15);
        }

        h1{
            text-align:center;
            color:#6a0dad;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"],
        button{
            width:100%;
            padding:12px;
            margin: 10px 0;
            box-sizing:border-box;
            border:1px solid #d1c4e9;
            border-radius:6px;
            font-size:16px;

        }
        input[type="submit"]{
            background-color:#6a0dad;
            color:white;
            border:none;
            cursor:pointer;
        }
        input[type="submit"]:hover {
            background-color:#7e3ff2;
        }
        button {
            background-color:#a167e7;
            color:white;
            border:none;
            cursor:pointer;
        }
        button:hover {
            background-color:#c19df0;
        }

    </style>
</head>
<body>

    <h1>Login</h1>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
        <br>
        <br>
        
        <button onclick="window.location.href='register.php'">Register</button>


    </form>
</body>
</html>
