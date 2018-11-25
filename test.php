<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include './connection.php';

        $query = "SELECT * FROM services";
        $result = mysqli_query($link, $query);
        ?>
        <select name="services">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['SERVICE_NAME'] . "'>" . $row['SERVICE_NAME'] . "</option>";
            }
            ?>
        </select>


    </body>
</html>
