    <!DOCTYPE html>
    <html>
        <head>
            <title>რეფერალები</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="Style/Style.css">
            <script type="text/javascript" src="Scripts/main.js"></script>
        </head>
        <body>
            <?php require './navbar.php'; ?>
            <?php require './loginsession.php'; ?>
            <div align="center">
                <div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="validateSearchBox();">
                        <input type="text" name="referralidnumber" id="referralidnumber" class="textbox" autocomplete="off" autofocus="" placeholder="ძიების დასაწყებად შეიყვანეთ რეფერალის პირადი #...">
                        <input type="submit" id="submit" name="submit" class="button" value="მომხმარებლის ძებნა">
                    </form>
                </div>
                <table>
                    <?php
                    include './connection.php';
                    $referralidnumber = filter_input(INPUT_POST, 'referralidnumber');
                    $query = "SELECT * FROM MEMBERS WHERE REFERRAL_ID = '$referralidnumber' AND NEXT_PAYMENT_DATE > CURRENT_DATE";
                    $result = mysqli_query($link, $query);

                    if (filter_input(INPUT_POST, 'submit')) {
                        if ($referralidnumber != "") {
                            if (mysqli_num_rows($result) > 0) {
                                $counter = 1;
                                echo "<thead>"
                                . "<th>#</th>"
                                . "<th>სახელი</th>"
                                . "<th>გვარი</th>"
                                . "<th>სერვისი</th>"
                                . "<th>დღეები</th>"
                                . "<th>საათები</th>"
                                . "</thead>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tbody>"
                                    . "<td>" . $counter . "</td>"
                                    . "<td>" . $row['FIRST_NAME'] . "</td>"
                                    . "<td>" . $row['LAST_NAME'] . "</td>"
                                    . "<td>" . $row['SERVICE'] . "</td>"
                                    . "<td>" . $row['DAYS'] . "</td>"
                                    . "<td>" . $row['HOURS'] . "</td>"
                                    . "</tbody>";
                                    $counter++;
                                }
                            } elseif (mysqli_num_rows($result) == 0) {
                                echo "<p align='center' class='result' style='color: #CB0520'>რეფერალები მითითებული პირადი ნომრისთვის არ მოიძებნა.</p>";
                            }
                        } else {
                            echo "<p align='center' class='result' style='color: #CB0520'>რეფერალის პირადი ნომრის შესაყვანი ველი ცარიელია.</p>";
                        }
                    }
                    mysqli_close($link);
                    ?>
                </table>
            </div>
        </body>
    </html>
