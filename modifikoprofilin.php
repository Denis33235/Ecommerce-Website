<?php include "inc/header.php"; ?>

<section id="content" class="box">

    <?php
    if (isset($_GET['pid'])) {
        $perdoruesi = merrPerdoruesId($_GET['pid']);
        $userid = $perdoruesi['userid'];
        $emri_perdoruesit = $perdoruesi['emri_perdoruesit'];
        $email = $perdoruesi['email'];
        $fjalekalimi = $perdoruesi['fjalekalimi'];
        $telefoni = $perdoruesi['telefoni'];
    }
    if (isset($_POST['ruaj'])) {
        $userid = $_SESSION['userid'];
        modifikoProfilin(
            $userid,
            $_POST['emri_perdoruesit'],
            $_POST['email'],
            $_POST['fjalekalimi'],
            $_POST['telefoni'],

        );
    }
    ?>
    <form id="regjistrohu" method="POST">
        <legend>Ndrysho te dhenat e tua</legend>
        <fieldset>
            <input type="hidden" id="userid" name="userid">
            <label>Emri: </label>
            <input type="text" id="emri_perdoruesit" name="emri_perdoruesit" value='<?php if (!empty($emri_perdoruesit)) echo $emri_perdoruesit; ?>'>
        </fieldset>
        <fieldset>
            <label>Mbiemri: </label>
            <input type="text" id="email" name="email" value='<?php if (!empty($email)) echo $email; ?>'>
        </fieldset>
        <fieldset>
            <label>Fjalekalimi: </label>
            <input type="password" id="fjalekalimi" name="fjalekalimi" value='<?php if (!empty($fjalekalimi)) echo $fjalekalimi; ?>'>
        </fieldset>
        <fieldset>
            <label>Telefoni: </label>
            <input type="text" id="telefoni" name="telefoni" value='<?php if (!empty($telefoni)) echo $telefoni; ?>'>
        </fieldset>
        <input type="submit" name="ruaj" id="ruaj" value="Ruaj">
    </form>

</section>
</main>
<?php include "inc/footer.php"; ?>