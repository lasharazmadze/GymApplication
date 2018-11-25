<!DOCTYPE html>
<html>
    <head>
        <title>ტრანზაქციის შედეგი</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Style/Style.css">
        <script type="text/javascript" src="Scripts/main.js"></script>
    </head>
    <body>
        <?php require './navbar.php'; ?>
        <?php require './loginsession.php'; ?>
        <div align="center">
            <br>
            <?php
            if (isset($_SESSION['paymentsuccessmessage'])) {
                echo $_SESSION['paymentsuccessmessage'];
                echo "სახელი: " . $_SESSION['firstname'] . "<br>"
                . "გვარი: " . $_SESSION['lastname'];
            } elseif (isset($_SESSION['paymentfailuremessage'])) {
                echo $_SESSION['paymentfailuremessage'];
            } elseif (isset($_SESSION['deletesuccessmessage'])) {
                echo $_SESSION['deletesuccessmessage'];
            } elseif (isset($_SESSION['deletefailuremessage'])) {
                echo $_SESSION['deletefailuremessage'];
            }
            if (isset($_SESSION['paymentsuccessmessage'])) {
                unset($_SESSION['paymentsuccessmessage']);
            } elseif (isset($_SESSION['paymentfailuremessage'])) {
                unset($_SESSION['paymentfailuremessage']);
            } elseif (isset($_SESSION['deletesuccessmessage'])) {
                unset($_SESSION['deletesuccessmessage']);
            } elseif (isset($_SESSION['deletefailuremessage'])) {
                unset($_SESSION['deletefailuremessage']);
            }
            ?>
        </div>
    </body>
</html>
