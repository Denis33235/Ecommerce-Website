
<?php
session_start();
$dbconn;
function dbConn()
{
    global $dbconn;
    $dbconn = mysqli_connect("localhost", 'root', '', 'shop');
    if (!$dbconn) {
        die("Deshtoi lidhja me DB" . mysqli_connect_error());
    }
}
dbConn();
if (isset($_GET['argument']) && $_GET['argument'] == 'dalja') {
    session_destroy();
    echo "index.php";
    exit; // 
}

function regjistroPerdorues($emri_perdoruesit, $telefoni, $email, $fjalekalimi)
{
    global $dbconn;

    // Check if any of the input parameters are empty or null
    if (empty($emri_perdoruesit) || empty($telefoni) || empty($email) || empty($fjalekalimi)) {
        return "Te dhenat nuk duhet te jene te zbrazeta.";
    }

    $email_check_sql = "SELECT userid FROM perdoruesit WHERE email='$email'";
    $email_check_result = mysqli_query($dbconn, $email_check_sql);
    $existing_email = mysqli_fetch_assoc($email_check_result);

    if ($existing_email) {
        return "Keto te dhena ekzistojne ne bazen e te dhenave.";
    }

    $insert_sql = "INSERT INTO perdoruesit(emri_perdoruesit, telefoni, email, fjalekalimi)";
    $insert_sql .= " VALUES('$emri_perdoruesit', '$telefoni', '$email', '$fjalekalimi')";

    if (mysqli_query($dbconn, $insert_sql)) {
        // Start a session for the user upon successful registration
        $_SESSION['perdoruesi'] = $emri_perdoruesit; // Set a session variable
        return "Regjistrimi u be me sukses. Kyquni me kredencialet tuaja." .  header("Location:index.php");
    } else {
        return "Deshtoi regjistrimi: " . mysqli_error($dbconn);
    }
}



function login($email, $fjalekalimi)
{
    global $dbconn;

    $sql = "SELECT userid, emri_perdoruesit, email, data_regjistrimit, telefoni, fjalekalimi FROM perdoruesit";
    $sql .= " WHERE email='$email' AND fjalekalimi='$fjalekalimi'";

    $result = mysqli_query($dbconn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $perdoruesData = mysqli_fetch_assoc($result);
        $_SESSION['userid'] = $perdoruesData['userid'];
        $perdoruesi = array();
        $perdoruesi['userid'] = $perdoruesData['userid'];
        $perdoruesi['emri_perdoruesit'] = $perdoruesData['emri_perdoruesit'];
        $perdoruesi['telefoni'] = $perdoruesData['telefoni'];
        $perdoruesi['email'] = $perdoruesData['email'];
        $perdoruesi['fjalekalimi'] = $perdoruesData['fjalekalimi'];
        $_SESSION['perdoruesi'] = $perdoruesi;

        header("Location: profili.php");
        // }
    }
}

function userData($userid)
{
    global $dbconn;

    $sql = "SELECT userid, emri_perdoruesit, telefoni, email, fjalekalimi, data_regjistrimit FROM perdoruesit WHERE userid = $userid";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "Nuk ka shenime";
        return false;
    }
}


function merrProdukte()
{
    global $dbconn;
    $sql = "SELECT productid,emri,pershkrimi,cmimi,sasia_ne_stock  FROM produkte ";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo false;
    }
}
function merrProduktId($productid)
{
    global $dbconn;
    $sql = "SELECT productid,emri,pershkrimi,cmimi,sasia_ne_stock FROM produkte WHERE productid=$productid";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "Nuk ka shenime";
    }
}
function merrKategori()
{
    global $dbconn;
    $sql = "SELECT categoryid,emri  FROM kategorite ";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return $result;
    } else {
        echo "Nuk ka kategori";
    }
}
function merrKategoriId($categoryid)
{
    global $dbconn;
    $sql = "SELECT categoryid,emri from kategorite where categoryid=$categoryid";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "Nuk ka kategori";
    }
}
function merrPorosi()
{
    global $dbconn;
    $sql = "SELECT orderid,userid,data_porosise,shuma_totale from porosite";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return $result;
    } else {
        echo "Nuk ka porosi";
    }
}
function merrPorosiId($orderid)
{
    global $dbconn;
    $sql = "SELECT orderid,userid,data_porosise,shuma_totale from porosite where orderid=$orderid";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "nuk ka porosi";
    }
}
function shtoPorosi($data_porosise, $shuma_totale)
{

    global $dbconn;
    $sql = "INSERT INTO porosite(data_porosite,shuma_totale)";
    $sql .= " VALUES ('$data_porosise','$shuma_totale')";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        echo "Porosia u shtua me sukses";
    } else {
        echo 'Deshtoi shtimi i porosise';
        die(mysqli_error($dbconn));
    }
}
function modifikoPorosi($orderid, $data_porosise, $shuma_totale)
{
    global $dbconn;
    $sql = "UPDATE porosite SET data_porosise='$data_porosise',shuma_totale='$shuma_totale' where orderid=$orderid";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        echo "Porosia u modifikua me sukses";
    } else {
        echo 'Deshtoi modifikimi i porosise';
        die(mysqli_error($dbconn));
    }
}
function fshijPorosi($orderid)
{
    global $dbconn;
    $sql = "DELETE FROM porosite  WHERE orderid=$orderid";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        echo "Porosia u fshi me sukses";
        header("Location: porosite.php");
    } else {
        echo 'Deshtoi fshirja e porosise';
        die(mysqli_error($dbconn));
    }
}
function modifikoProfilin($userid, $emri_perdoruesit, $email, $telefoni, $fjalekalimi)
{
    global $dbconn;
    $sql = "UPDATE perdoruesit SET emri_perdoruesit='$emri_perdoruesit', email='$email', ";
    $sql .= "telefoni='$telefoni', fjalekalimi='$fjalekalimi' WHERE userid=$userid";

    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        header("Location: profili.php");
        echo "Profiliu modifikua me sukses";
    } else {
        echo 'Deshtoi modifikimi i Profilit';
        die(mysqli_error($dbconn));
    }
}
function merrPerdoruesId($userid)
{
    global $dbconn;
    $sql = "SELECT userid,emri_perdoruesit,email,data_regjistrimit,telefoni,fjalekalimi from perdoruesit where userid=$userid";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "Nuk ka perdorues id";
    }
}
function merrArtikujtPorosive()
{
    global $dbconn;
    $sql = "SELECT orderitem_id,orderid,productid,sasia,subtotali from artikujt_porosise";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return $result;
    } else {
        echo "Nuk ka artikuj";
    }
}
function merrArtikujtPorosiveId($orderitem_id)
{
    global $dbconn;
    $sql = "SELECT orderitem_id,orderid,productid,sasia,subtotali from artikujt_porosise where orderitem_id=$orderitem_id";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        echo "Nuk ka arikuj id";
    }
}
function getAllClothes()
{
    global $dbconn;
    $sql = "SELECT * FROM produkte";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        $clothingProducts = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $clothingProducts[] = $row;
        }
        return $clothingProducts;
    } else {
        die(mysqli_error($dbconn));
    }
}

function getProductImageURL($productId)
{

    return 'img/' . $productId . '.jpg';
}
function getDuksa()
{
    global $dbconn;
    $sql = "SELECT productid, emri, cmimi from produkte where categoryid=1";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        $duksa = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $duksa[] = $row;
        }
        return $duksa;
    } else {
        die(mysqli_error($dbconn));
    }
}
function getJelek()
{
    global $dbconn;
    $sql = "SELECT productid, emri, cmimi from produkte where categoryid=2";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        $jelek = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $jelek[] = $row;
        }
        return $jelek;
    } else {
        die(mysqli_error($dbconn));
    }
}
function getJakne()
{
    global $dbconn;
    $sql = "SELECT productid, emri, cmimi from produkte where categoryid=3";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        $jakne = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $jakne[] = $row;
        }
        return $jakne;
    } else {
        die(mysqli_error($dbconn));
    }
}
function removeFromCart($productId)
{
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['productId'] == $productId) {
                unset($_SESSION['cart'][$key]);
                return;
            }
        }
    }
}
