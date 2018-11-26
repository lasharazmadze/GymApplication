<!DOCTYPE html>
<html>
    <head>
        <title>ინფორმაციის რედაქტირება</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Style/Style.css">
        <script type="text/javascript" src="Scripts/main.js"></script>
    </head>
    <body>
        <?php require './navbar.php'; ?>
        <?php require './loginsession.php'; ?>
        <?php require './connection.php'; ?>  
        <div align="center">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="validateFields();">
                <div>
                    <input type="text" name="firstname" id="firstname" class="textbox" placeholder="შეიყვანეთ მომხმარებლის სახელი..." value="<?php echo $_SESSION['firstname'] ?>">
                    <input type="text" name="lastname" id="lastname" class="textbox" placeholder="შეიყვანეთ მომხმარებლის გვარი..." value="<?php echo $_SESSION['lastname'] ?>">
                    <input type="text" name="mobilenumber" id="mobilenumber" class="textbox" placeholder="შეიყვანეთ მომხმარებლის ტელეფონის ნომერი..." value="<?php echo $_SESSION['mobilenumber'] ?>">
                    <input type="text" name="referralid" id="referralid" class="textbox" placeholder="შეიყვანეთ რეფერალის პირადი ნომერი..." value="<?php echo $_SESSION['referralid'] ?>">
                    <select name="service" id="service" class="selectbox" onchange="changeSelect()">
                        <option value="<?php echo $_SESSION['service']; ?>"><?php echo $_SESSION['service']; ?></option>
                        <?php
                        $query = "SELECT * FROM services";
                        $result = mysqli_query($link, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['SERVICE_NAME'] . "'>" . $row['SERVICE_NAME'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="days" id="days" class="selectbox" onchange="changeSelect()">
                        <option value="<?php echo $_SESSION['days']; ?>"><?php echo $_SESSION['days']; ?></option>
                        <?php
                        $query = "SELECT * FROM days";
                        $result = mysqli_query($link, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['DAYS_NAME'] . "'>" . $row['DAYS_NAME'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="hours" id="hours" class="selectbox" onchange="changeSelect()">
                        <option value="<?php echo $_SESSION['hours']; ?>"><?php echo $_SESSION['hours']; ?></option>
                        <?php
                        $query = "SELECT * FROM hours";
                        $result = mysqli_query($link, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['HOURS_NAME'] . "'>" . $row['HOURS_NAME'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
        </div>
        <div align="center">
            <input type="submit" name="submit" value="შენახვა" class="button">
            <input type="reset" value="წაშლა" class="button">
        </div>
    </form>
    <?php
    include './connection.php';
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $idnumber = $_SESSION['idnumber'];
    $mobilenumber = filter_input(INPUT_POST, 'mobilenumber');
    $referralid = filter_input(INPUT_POST, 'referralid');
    $service = filter_input(INPUT_POST, 'service');
    $days = filter_input(INPUT_POST, 'days');
    $hours = filter_input(INPUT_POST, 'hours');
    $query = "UPDATE MEMBERS SET FIRST_NAME = '$firstname', LAST_NAME = '$lastname', MOBILE_NUMBER = '$mobilenumber', REFERRAL_ID = '$referralid', SERVICE = '$service', DAYS = '$days', HOURS = '$hours' WHERE ID_NUMBER = '$idnumber'";
    if (filter_input(INPUT_POST, 'submit')) {
        if (mysqli_query($link, $query)) {
            echo "<p align='center' class='result' style='color: #CB0520'>მონაცემები წარმატებით განახლდა.</p>";
        } else {
            echo "<p align='center' class='result' style='color: #CB0520'>შეცდომა მონაცემების განახლებისას ." . mysqli_error($link);
        }
    }
    mysqli_close($link);
    ?>
</div>
</body>
</html>
