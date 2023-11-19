<?php
include "inc/header.php";
include_once "inc/functions.php";
?>
<section id="content" class="box">
    <h3 class="user-intro">Te dhenat e juaja</h3>
    <?php
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $user = userData($userid);

        if ($user) {
            echo "<p class='user-info'><span>Emri: </span>" . $user['emri_perdoruesit'];
            echo "<p class='user-info'><span>Email: </span>" . $user['email'];
            echo "<p class='user-info'><span>Fjalekalimi: </span>" . $user['fjalekalimi'];
            echo "<p class='user-info'><span>Telefoni: </span>" . $user['telefoni'];
            echo "<p class='user-info'><span>Data e regjistrimit: </span>" . $user['data_regjistrimit'];
            echo "<p class='user-button'><a href='modifikoprofilin.php?pid=$userid'>Ndrysho te dhenat</a></td>";
        } else {
            echo "User data not found.";
        }
    } else {
        echo "User not logged in.";
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    ?>

</section>
</main>
<?php include "inc/footer.php"; ?>