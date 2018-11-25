<!DOCTYPE html>
<html>
    <head>
        <title>მომხმარებლების სრული სია</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Style/Style.css">
        <script type="text/javascript" src="Scripts/main.js"></script>
    <body>
        <?php require './navbar.php'; ?>
        <?php require './loginsession.php'; ?>
        <div align = "center">
            <table>
                <?php
                include 'connection.php';
                $query = "SELECT * FROM MEMBERS WHERE NEXT_PAYMENT_DATE < CURRENT_DATE ORDER BY NEXT_PAYMENT_DATE DESC";
                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {
                    $counter = 1;
                    echo "<p align='center' class='result' style='color: #CB0520'>მომხმარებელთა სია, რომელთა სტატუსიც შეჩერებულია</p>"
                    . "<thead>"
                    . "<tr>"
                    . "<th>#</th>"
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
                    . "<th></th>"
                    . "</tr>"
                    . "</thead>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tbody>"
                        . "<tr>"
                        . "<td>" . $counter . "</td>"
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
                        . "<td><a href='pay.php'>გადახდა</a></td>"
                        . "</tr>"
                        . "</tbody>";
                        $counter++;
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
                }
                mysqli_close($link);
                ?>
            </table>
            <br>

            <table>
                <?php
                include './connection.php';
                mysqli_set_charset($link, "utf8");
                $query = "SELECT * FROM MEMBERS ORDER BY REGISTRATION_DATE DESC";
                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {
                    $counter = 1;
                    echo "<p align='center' class='result' style='color: #CB0520'>მომხმარებელთა სრული სია</p>"
                    . "<thead>"
                    . "<tr>"
                    . "<th>#</th>"
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
                    . "</thead>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tbody>"
                        . "<tr>"
                        . "<td>" . $counter . "</td>"
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
                        . "</tr>"
                        . "</tbody>";
                        $counter++;
                    }
                } else {
                    echo "<p align='center' class='result' style='color: #CB0520'>მოცემული მომენტისთვის მონაცემთა ბაზაში არცერთი ჩანაწერი არ ფიქსირდება.</p>";
                }
                mysqli_close($link);
                ?>
            </table>
        </div>
    </body>
</html>
