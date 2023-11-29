<?php
include "header.php";
include "config.php";

if (isset($_FILES['fileToUpload'])) {
    $errors = array();
    $file_name = $_FILES["fileToUpload"]["name"];
    $file_size = $_FILES["fileToUpload"]["size"];
    $file_type = $_FILES["fileToUpload"]["type"];
    $file_temp = $_FILES["fileToUpload"]["tmp_name"];

    $file_ext = strtolower(end(explode('.', $file_name)));
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


    $title = mysqli_escape_string($conn, $_POST['post_title']);
    $postdesc = mysqli_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_escape_string($conn, $_POST['category']);
    $date = date("d,M, Y");
    $author = $_SESSION['user_id'];

    $sql = "INSERT INTO post(`title`,`description`,`category`,`post_date`,`author`,`post_img`)
     VALUES('$title' ,'$postdesc','$category','$date',$author,'$new_img_name');";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = '$category'";
    if (mysqli_multi_query($conn, $sql)) {
        header("Location:" . $REDIRECT_URL_FOR_USER);
    } else {
        echo "<P> query failed.</P>";
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <option value="" disabled> Select Category</option>
                            <?php
                            $sql = "SELECT * FROM category";
                            $result = mysqli_query($conn, $sql) or die("query failed");

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value={$row['category_id']}>{$row['category_name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>