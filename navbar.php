<?php
session_start();
?>
<div>
    <ul>
        <li><a href="index.php">საწყისი გვერდი</a></li>
        <li><a href="add.php">ახალი მომხმარებლის დამატება</a></li>
        <li><a href="list.php">მომხმარებელთა სია</a></li>
        <li><a href="referrals.php">რეფერალები</a></li>
        <li><a href="manual.php">ინსტრუქცია</a></li>
        <?php
        if (isset($_SESSION['username'])) {
            echo "<li style='float: right'><a style='' href='#' onclick='confirmLogout();'>სისტემიდან გასვლა</a></li>";
        }
        ?>
    </ul>
</div>