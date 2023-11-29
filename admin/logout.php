<?php
include "config.php";
session_unset();
session_destroy();
header("Location:http://localhost/news-template/admin/");
?>
