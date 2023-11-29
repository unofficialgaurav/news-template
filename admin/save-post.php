<?php
include "config.php";


if (isset($_FILES['fileToUpload'])) {

    $errors = array();
    $file_name = $_FILES["fileToUpload"]["name"];
    $file_size = $_FILES["fileToUpload"]["size"];
    $file_type = $_FILES["fileToUpload"]["type"];
    $file_temp = $_FILES["fileToUpload"]["tmp_name"];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extension = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extension) === false) {
        $errors[] = "This extension is not valid , Please choose jpg , PNG , jpeg";
    }
    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_temp, "upload/" . $file_name);
    } else {
        print_r($errors);
        die();
    }
}

$title = mysqli_escape_string($conn, $_POST['post_title']);
$postdesc = mysqli_escape_string($conn, $_POST['postdesc']);
$category = mysqli_escape_string($conn, $_POST['category']);
$date = date("d,M, Y");
$author = $_SESSION['user_id'];

$sql = "INSERT INTO post(`title`,`description`,`category`,`post_date`,`author`,`post_img`)
 VALUES($title ,$postdesc,$category,$date,'asd',$file_name)";
$sql .= "UPDATE category SET post = post + 1 WHERE 'category_id' = $category";
if (mysqli_query($conn, $sql)) {
    header("Location:" . $REDIRECT_URL_FOR_USER);
} else {
    echo "<P> query failed.</P>";
}
