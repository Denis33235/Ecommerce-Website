<?php
include('inc/functions.php');
?>
<!DOCTYPE html>

<html lang="en">
<style>
    body img {
        position: absolute;
        top: 10px;
        left: 10px;
    }
</style>

<head>
    <?php
    if (isset($_POST['login'])) {
        login($_POST['email'], $_POST['fjalekalimi']);
    }
    ?>
    <meta charset="UTF-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="loginstyle.css" />
    <script src="jquery-3.6.0.js"></script>
    <script src="slick.min.js"></script>
    <script src="jquery.validate.min.js"></script>

</head>

<body style="display: flex; justify-content:center ; align-items: center;height: 100vh;overflow: hidden;">
    <a href="index.php">
        <img src="img/logo.png">
    </a>
    <?php
    if (isset($_SESSION['perdoruesi'])) {
        header("Location: index.php");
        exit;
    } else {
        echo '<div class="container">
            <form id="loginForm" class="box" method="post">
                <h4>Login</h4>
                <h5>Sign in to your account.</h5>
                <input type="text"class="email" name="email" placeholder="Email" autocomplete="off" />
                <input type="password" class="fjalekalimi"name="fjalekalimi" placeholder="Password" id="pwd" autocomplete="off" />
                <a href="register.php" class="noacc">Don\'t have an account?</a>
                <input type="submit" value="Sign in" class="btn1" name="login" />
            </form>
        </div>';
    }
    ?>
</body>
<script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                fjalekalimi: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                fjalekalimi: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                email: {
                    required: "Please provide an email",
                    email: "Please enter a valid email address"
                }
            }


        });
    });
</script>

</html>