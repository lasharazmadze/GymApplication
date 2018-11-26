<!DOCTYPE html>
<html>
    <head>
        <title>ავტორიზაცია</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Style/Style.css">
        <script type="text/javascript" src="Scripts/main.js"></script>
    </head>
    <body>
        <?php require './navbar.php'; ?>
        <div align="center">
            <p>სისტემაში მუშაობის დასაწყებად აუცილებელია გაიაროთ ავტორიზაცია<p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div>
                    <input type="text" id="username" name="username" class="textbox" autocomplete="off" autofocus="" placeholder="შეიყვანეთ მომხმარებლის სახელი...">
                </div>
                <div>
                    <input type="password" id="password" name="password" class="textbox" autocomplete="off" placeholder="შეიყვანეთ მომხმარებლის პაროლი...">
                </div>
                <input type="submit" id="submit" name="submit" class="button" value="სისტემაში შესვლა">
            </form>
            <?php
            if (filter_input(INPUT_POST, 'submit')) {
                if (strlen(filter_input(INPUT_POST, 'username')) != 0 and strlen(filter_input(INPUT_POST, 'password')) != 0) {
                    include './connection.php';
                    $username = filter_input(INPUT_POST, 'username');
                    $password = filter_input(INPUT_POST, 'password');
                    $query = "SELECT USERNAME, PASSWORD FROM USERS WHERE USERNAME='$username' AND PASSWORD='$password'";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_num_rows($result);
                    if ($row != 0) {
                        while (mysqli_fetch_assoc($result)) {
                            session_start();
                            $_SESSION['username'] = $username;
                            header("Location: index.php");
                        }
                    } else {
                        echo "<p align='center' class='result' style='color: #CB0520'>მომხმარებლის სახელი ან პაროლი არასწორია.</p>";
                    }
                } elseif (strlen(filter_input(INPUT_POST, 'username')) == 0 or strlen(filter_input(INPUT_POST, 'password')) == 0) {
                    echo "<p align='center' class='result' style='color: #CB0520'>მომხმარებლის სახელის ან პაროლის ველი ცარიელია.</p>";
                }
            }
            ?>
        </div>
    </body>
</html>
