<?php

session_start();
$currentdate = date("Y-m-d");
$idnumber = $_SESSION['idnumber'];
require './connection.php';
require './loginsession.php';
if ($_SESSION['paydate'] <= $currentdate) {
    $query = "UPDATE MEMBERS SET NEXT_PAYMENT_DATE=DATE_ADD(CURRENT_DATE(), INTERVAL 1 MONTH) WHERE ID_NUMBER=$idnumber";
} elseif ($_SESSION['paydate'] > $currentdate) {
    $query = "UPDATE MEMBERS SET NEXT_PAYMENT_DATE=DATE_ADD(NEXT_PAYMENT_DATE, INTERVAL 1 MONTH) WHERE ID_NUMBER=$idnumber";
}
if (mysqli_query($link, $query)) {
    $_SESSION['paymentsuccessmessage'] = "<p align='center' class='result' style='color: #0A6CB9'>გადახდის ოპერაცია წარმატებით შესრულდა.</p>";
    header('Location: results.php');
    sleep(3);
    exit();
} else {
    $_SESSION['paymentfailuremessage'] = "<p align='center' class='result' style='color: #CB0520'>გადახდის ოპერაციისას დაფიქსირდა შეცდომა.</p>";
    header('Location: results.php');
    sleep(3);
    exit();
}
?>
