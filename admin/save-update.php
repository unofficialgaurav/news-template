<?php
include "config.php";
$postid = mysqli_escape_string($conn, $_POST['post_id']);
$title = mysqli_escape_string($conn, $_POST['post_title']);
$description = mysqli_escape_string($conn, $_POST['postdesc']);
// $postimg = mysqli_escape_string($conn, $_POST['username']);
$category = mysqli_escape_string($conn, $_POST['category']);
$new_img_name = $_POST['old-image'];

if (empty($_FILES['new-image']['name'])) {
    $new_img_name = $_POST['old-image'];
} else {
    $errors = array();
    $file_name = $_FILES["new-image"]["name"];
    $file_size = $_FILES["new-image"]["size"];
    $file_type = $_FILES["new-image"]["type"];
    $file_temp = $_FILES["new-image"]["tmp_name"];
    $file_ext = (end(explode('.', $file_name)));
    $new_img_name = rand(10000000, 999999999) . "." . $file_ext;

    $extension = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extension) === false) {
        $errors[] = "This extension is not valid , Please choose jpg , PNG , jpeg";
    }
    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_temp, "upload/" . $new_img_name);
    } else {
        print_r($errors);
        die();
    }
}
$sql = "UPDATE post SET title='$title',description='$description',
        category='$category',post_img='$new_img_name' WHERE post_id='$postid'";
$result = mysqli_query($conn, $sql);
if ($result) {

    header("Location:" . $REDIRECT_URL_FOR_USER);
} else {
    echo "queri failed";
}
