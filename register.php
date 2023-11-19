<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="loginstyle.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-xxzC4r7pIXCyUTJp8t6d7z5u5GpTJ/ko3tB5F5w5j6fF5l5u5I5j5B5u5C5B5D5E5v5E5f5t5J5/5o5r5l5a5o5D5f5e5r5r5B5D5F5g5D5p5J5w5r5X5u5T5z5E5C5K5" crossorigin="anonymous">
    <script src="jquery-3.6.0.js"></script>
    <script src="slick.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .mesazhi {
            position: fixed;
            top: 75%;
            
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }

        body img {
            position: absolute;
            top: 10px;
            left: 10px
        }

        body p {
            position: absolute;
            top: 10px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#registrationForm").validate({
                
            });
        });
    </script>
</head>

<body style="display: flex; justify-content:center ; align-items: center;height: 100vh;overflow: hidden;">
    <a href="index.php">
        <img src="img/logo.png">
    </a>
    <div class="container">

        <form id="registrationForm" class="box" method="post">

            <h4>Sign Up</h4>
            <input type="text" name="emri_perdoruesit" placeholder="Emri" />
            <input type="text" name="email" placeholder="Email" />
            <input type="text" name="telefoni" placeholder="Telefoni" />
            <input type="password" name="fjalekalimi" placeholder="Password" id="pwd" />
            <input type="submit" name="ruaj" value="Sign up" class="btn1" />
        </form>
        <?php
        include "inc/functions.php";

        if (isset($_POST['ruaj'])) {
            $result = regjistroPerdorues($_POST['emri_perdoruesit'], $_POST['telefoni'], $_POST['email'], $_POST['fjalekalimi']);
            if ($result === true) {
                echo "<p style='color:red;' class='mesazhi'>Jeni regjistruar me sukses</p>";
            } else {
                echo "<p style='color:red;' class='mesazhi'>$result</p>";
            }
        }
        ?>
    </div>
</body>

</html>