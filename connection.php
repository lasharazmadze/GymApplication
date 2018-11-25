<?php

$link = mysqli_connect("localhost", "lasharazmadze", "dashla123", "razmadzegym");

if ($link === FALSE) {
    die("მონაცემთა ბაზასთან დაკავშირება შეუძლებელია " . mysqli_connect_error());
}
mysqli_set_charset($link, "utf8");
