<?php

session_start();
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$idnumber = $_SESSION['idnumber'];
require './connection.php';
require './loginsession.php';
$query = "DELETE FROM MEMBERS WHERE ID_NUMBER='$idnumber'";
if (mysqli_query($link, $query)) {
    $_SESSION['deletesuccessmessage'] = "<p align='center' class='result' style='color: #316691'>მომხმარებელი " . $firstname . " " . $lastname . " წარმატებით წაიშალა მონაცემთა ბაზიდან.</p>";
    header('Location: results.php');
    exit();
} else {
    $_SESSION['deletefailuremessage'] = "<p align='center' class='result' style='color: #CB0520'>მომხმარებლის ბაზიდან წაშლისას დაფიქსირდა შეცდომა.</p>";
    header('Location: results.php');
    exit();
}
?>
