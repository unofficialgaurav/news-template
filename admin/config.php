<?php
if (!isset($_SESSION)) {
    session_start();
}

$conn = mysqli_connect("localhost", "root", "", "news-site") or die("connection failed");


// GLOBAL VARIABLES

$REDIRECT_URL_AFTER_LOGIN = "users.php";
$REDIRECT_URL_BEFORE_LOGIN = "index.php";
$REDIRECT_URL_FOR_USER = "post.php";
