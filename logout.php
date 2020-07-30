<?php
include "header.html";

session_start();

session_destroy();

header("Location:/DayClass/index.php");

include "footer.html";
?>