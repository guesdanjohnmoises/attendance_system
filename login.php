<?php

$conn = mysqli_connect("localhost","root","","school_attendance");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0)
    {
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login - Mil-an NHS</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            background:white;
            padding:30px;
            width:350px;
            border-radius:10px;
            box-shadow:0px 0px 10px rgba(0,0,0,0.1);
            text-align:center;
        }

        img{
            width:100px;
        }

        input{
            width:100%;
            padding:10px;
            margin-top:10px;
            margin-bottom:10px;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:10px;
            background:#1e3a8a;
            color:white;
            border:none;
            cursor:pointer;
        }

        .error{
            color:red;
            margin-bottom:10px;
        }

    </style>

</head>

<body>

<div class="login-box">

    <img src="images/logo.png">

    <h2>Mil-an National High School</h2>

    <p>Attendance Monitoring System</p>

    <?php
    if(isset($error))
    {
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

    </form>

</div>

</body>
</html>