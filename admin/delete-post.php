<?php
include "config.php";

if ((int)$_SESSION['role'] == 0) {
    header("location:" . $REDIRECT_URL_FOR_USER);
}

$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql1 = "SELECT *  FROM `post` WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql1) or die("query failed : select");
$row = mysqli_fetch_assoc($result);

unlink("upload/" . $row['post_img']);

$sql = "DELETE FROM `post` WHERE post_id = $post_id";
// $sql .= "UPDATE category SET post= post - 1 WHERE category_id = $cat_id ";

if (mysqli_query($conn, $sql)) {
    header("Location:http://localhost/news-template/admin/post.php");
} else {
    echo "went wrong..!!";
}
