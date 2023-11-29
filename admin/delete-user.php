<?php
include "config.php";

if ((int)$_SESSION['role'] == 0) {
    header("location:" . $REDIRECT_URL_FOR_USER);
}

$userID = $_GET['id'];

$sql = "DELETE FROM `user` WHERE user_id = '{$userID}'";

if (mysqli_query($conn, $sql)) {
    header("Location:http://localhost/news-template/admin/users.php");
} else {
    echo "went wrong..!!";
}
