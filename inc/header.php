<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/7d529c9d49.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <?php include "inc/functions.php"; ?>
    <title>Giovanni Menswear</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="index.php">
                        <img src="img/logo.png">
                        <p>Giovanni Menswear</p>
                    </a>
                </div>
                <div class="navbar">
                    <div class="nav-items">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href='about.php'>About</a></li>

                            <?php
                            if (isset($_SESSION['perdoruesi'])) {
                                echo "<li><a href='shopnow.php'>Store</a></li>";
                                echo "<li><a href='logout.php'>Dalja</a></li>";
                                echo "<li><a href='profili.php'>Profile</a></li>";
                                echo "<li><a href='cart.php'><i class='bx bxs-cart-alt'></i></a></li>";
                            } else {
                                echo "<li><a href='login.php'>Log In</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>