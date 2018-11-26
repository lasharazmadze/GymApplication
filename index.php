<!DOCTYPE html>
<html>
    <head>
        <title>საწყისი გვერდი</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Style/Style.css">
        <script type="text/javascript" src="Scripts/main.js"></script>
    </head>
    <body>
        <?php require './navbar.php'; ?>
        <?php require './loginsession.php'; ?>
        <div align="center">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div>
                    <input type="text" id="idnumber" name="idnumber" class="textbox" maxlength="20" autocomplete="off" autofocus="" placeholder="შეიყვანეთ მომხმარებლის პირადი ნომერი...">
                    <input type="submit" id="submit" name="submit" class="button" value="მომხმარებლის ძებნა">
                </div>
            </form>
            <?php
            include './connection.php';
            $idnumberval = filter_input(INPUT_POST, 'idnumber');
            $query = "SELECT * FROM MEMBERS WHERE ID_NUMBER ='$idnumberval'";
            $result = mysqli_query($link, $query);

            if (filter_input(INPUT_POST, 'submit')) {
                if ($idnumberval != "") {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<br>"
                            . "<table>"
                            . "<thead>"
                            . "<tr>"
                            . "<th>სახელი</th>"
                            . "<th>გვარი</th>"
                            . "<th>პირადი #</th>"
                            . "<th>ტელეფონის #</th>"
                            . "<th>რეფერალის #</th>"
                            . "<th>სერვისი</th>"
                            . "<th>დღეები</th>"
                            . "<th>საათები</th>"
                            . "<th>რეგისტრაციის თარიღი</th>"
                            . "<th>მომდევნო გადახდის თარიღი</th>"
                            . "</tr>"
                            . "</thead>"
                            . "<tbody>"
                            . "<td>" . $row["FIRST_NAME"] . "</td>"
                            . "<td>" . $row["LAST_NAME"] . "</td>"
                            . "<td>" . $row["ID_NUMBER"] . "</td>"
                            . "<td>" . $row["MOBILE_NUMBER"] . "</td>"
                            . "<td>" . $row["REFERRAL_ID"] . "</td>"
                            . "<td>" . $row["SERVICE"] . "</td>"
                            . "<td>" . $row["DAYS"] . "</td>"
                            . "<td>" . $row["HOURS"] . "</td>"
                            . "<td>" . $row["REGISTRATION_DATE"] . "</td>"
                            . "<td>" . $row["NEXT_PAYMENT_DATE"] . "</td>"
                            . "</tbody>"
                            . "</table>"
                            . "<br>"
                            . "<a class='button' href='pay.php'>გადახდა</a>"
                            . "<a class='button' href='#' onclick='notAvaliable()'>სტატუსის დაპაუზება</a>"
                            . "<a class='button' href='edit.php'>მონაცემების ჩასწორება</a>"
                            . "<a class='button' href='delete.php'>წაშლა</a>";
                            $_SESSION['firstname'] = $row['FIRST_NAME'];
                            $_SESSION['lastname'] = $row['LAST_NAME'];
                            $_SESSION['idnumber'] = $row['ID_NUMBER'];
                            $_SESSION['mobilenumber'] = $row['MOBILE_NUMBER'];
                            $_SESSION['referralid'] = $row['REFERRAL_ID'];
                            $_SESSION['service'] = $row['SERVICE'];
                            $_SESSION['days'] = $row['DAYS'];
                            $_SESSION['hours'] = $row['HOURS'];
                            $_SESSION['paydate'] = $row['NEXT_PAYMENT_DATE'];
                        }
                    } elseif (mysqli_num_rows($result) == 0) {
                        echo "<p align='center' class='result' style='color: #CB0520'>მომხმარებელი პირადი ნომრით " . $idnumberval . " არ მოიძებნა მონაცემთა ბაზაში.</p>";
                    }
                } else {
                    echo "<p align='center' class='result' style='color: #CB0520'>პირადი ნომრის შესაყვანი ველი ცარიელია.</p>";
                }
            }
            mysqli_close($link);
            ?>
        </div>
    </body>
</html>
