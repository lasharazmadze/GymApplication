<!DOCTYPE html>
<html>
    <head>
        <title>ახალი მომხმარებელი</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Style/Style.css">
        <script type="text/javascript" src="Scripts/main.js"></script>
    </head>
    <body>
        <?php require './navbar.php'; ?>
        <?php require './loginsession.php'; ?>
        <?php include './connection.php'; ?>
        <div align="center">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="validateFields();">
                <div>
                    <input type="text" name="firstname" id="firstname" class="textbox" autocomplete="off" autofocus="" placeholder="შეიყვანეთ მომხმარებლის სახელი...">
                    <input type="text" name="lastname" id="lastname" class="textbox" autocomplete="off" placeholder="შეიყვანეთ მომხმარებლის გვარი...">
                    <input type="text" name="idnumber" id="idnumber" class="textbox" autocomplete="off" placeholder="შეიყვანეთ მომხმარებლის პირადი ნომერი...">
                    <input type="text" name="mobilenumber" id="mobilenumber" class="textbox" autocomplete="off" placeholder="შეიყვანეთ მომხმარებლის ტელეფონის ნომერი...">
                    <input type="text" name="referralid" id="referralid" class="textbox" autocomplete="off" placeholder="შეიყვანეთ რეფერალის პირადი ნომერი...">
                    <select name="service" id="service" class="selectbox" onchange="changeSelect()">
                        <option value="">აირჩიეთ სასურველი</option>
                        <?php
                        $query = "SELECT * FROM services";
                        $result = mysqli_query($link, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['SERVICE_NAME'] . "'>" . $row['SERVICE_NAME'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="days" id="days" class="selectbox" onchange="changeSelect()">
                        <option value="">აირჩიეთ სასურველი დღეები</option>
                        <?php
                        $query = "SELECT * FROM days";
                        $result = mysqli_query($link, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['DAYS_NAME'] . "'>" . $row['DAYS_NAME'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="hours" id="hours" class="selectbox" onchange="changeSelect()">
                        <option value="">აირჩიეთ სასურველი საათი</option>
                        <?php
                        $query = "SELECT * FROM hours";
                        $result = mysqli_query($link, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['HOURS_NAME'] . "'>" . $row['HOURS_NAME'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="slidercontainer">
                    <p class="result" style="color: #CB0520" id="paidmonthsval">წინასწარ გადახდილია 1 თვის გადასახადი</p>
                    <input type="range" class="slider" id="paidmonths" name="paidmonths" min="1" max="12" step="1" value="1" onchange="getPaidMonthsValue(this.value);">
                </div>
        </div>
        <div align="center">
            <input type="submit" value="მომხმარებლის დამატება" class="button">
            <input type="reset" value="პარამეტრების განულება" class="button">
        </div>
        <p class="result" style="color: #0A6CB9" id="errormessage"></p>
    </form>
    <?php
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $idnumber = filter_input(INPUT_POST, 'idnumber');
    $mobilenumber = filter_input(INPUT_POST, 'mobilenumber');
    $referralid = filter_input(INPUT_POST, 'referralid');
    $service = filter_input(INPUT_POST, 'service');
    $days = filter_input(INPUT_POST, 'days');
    $hours = filter_input(INPUT_POST, 'hours');
    $paidmonths = filter_input(INPUT_POST, 'paidmonths');
    $registrationdate = date("Y-m-d H:i:s");
    if ($paidmonths == 1) {
        $nextpaymentdate = strtotime("+1 month", strtotime($registrationdate));
        $nextpaymentdate = date("Y-m-d", $nextpaymentdate);
    } else {
        $nextpaymentdate = strtotime("+$paidmonths month", strtotime($registrationdate));
        $nextpaymentdate = date("Y-m-d", $nextpaymentdate);
    }


    if ($firstname != "") {
        $query = "INSERT INTO MEMBERS(FIRST_NAME, LAST_NAME, ID_NUMBER, MOBILE_NUMBER, REFERRAL_ID, SERVICE, DAYS, HOURS, REGISTRATION_DATE, NEXT_PAYMENT_DATE) VALUES ('$firstname', '$lastname', '$idnumber', '$mobilenumber', '$referralid', '$service', '$days', '$hours', '$registrationdate', '$nextpaymentdate')";
        if (mysqli_query($link, $query)) {
            echo "<p align='center' class='result' style='color: #CB0520'>ახალი მომხმარებელი " . $firstname . " " . $lastname . " წარმატებით დაემატა მონაცემთა ბაზაში. მომდევნო გადახდის თარიღია " . $nextpaymentdate . "</p>";
        } elseif (mysqli_errno($link) == 1062) {
            echo "<p align='center' class='result' style='color: #CB0520'>მომხმარებელი პირადი ნომრით " . $idnumber . " უკვე არსებობს მონაცემთა ბაზაში.";
        } else {
            echo mysqli_errno($link) . " " . mysqli_error($link);
        }
    }
    mysqli_close($link);
    ?>
</div>
</body>
</html>
