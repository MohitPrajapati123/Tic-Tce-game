<?php 
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'login success';
        header('location:Home.html');
    } else {
        $message[] = 'incorrect email or password!';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url("tic-tac-toe.png");
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            position: relative;
            width: 400px;
            padding: 40px;
            background: black;
            border-radius: 20px;
            box-shadow: 0 0 50px red;
            overflow: hidden;
        }

        .form-container h3 {
            font-size: 30px;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container .box {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #fff;
            background: transparent;
            color: #fff;
            outline: none;
        }

        .form-container .btn {
            width: 100%;
            padding: 10px;
            background: red;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            color: #000;
            cursor: pointer;
            margin-top: 20px;
        }

        .form-container .btn:hover {
            background: #09c;
        }

        .form-container p {
            text-align: center;
            color: #fff;
            margin-top: 20px;
        }

        .form-container p a {
            color: red;
            text-decoration: none;
            font-weight: 500;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }
        .message {
    position: absolute;
    top:30px;
    background-color: red;
    border-radius:1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    z-index: 1000; /* Ensures the message is on top of other elements */
}

.message span {
    font-size: 2rem;
    color: white;
}

.message i {
    cursor: pointer;
    color: white;
    font-size: 2.5rem;
}


    </style>
</head>
<body>
    <?php 
        if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>';
            }
        }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h3>Log-In</h3>
            <input type="email" name="email" placeholder="Enter your email" required class="box">
            <input type="password" name="password" placeholder="Enter your password" required class="box">
            <input type="submit" name="submit" value="Log-In" class="btn">
            <p>Don't have an account? <a href="register.php">Sign-Up</a></p>
        </form>
    </div>
</body>
</html>
