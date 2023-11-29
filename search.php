<?php include 'header.php';
$search_term = $_GET['search'];
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading"> Search: <?php echo $search_term; ?></h2>
                    <div class="post-container">
                        <div class="post-container">
                            <?php
                            if (isset($_GET['search'])) {
                                $search_term = $_GET['search'];
                            }
                            $sql = "SELECT * FROM post WHERE post.title LIKE '%{$search_term}%' OR post.description LIKE '%{$search_term}%'";
                            $result = mysqli_query($conn, $sql) or die("query failed");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $category_id = $row['category'];
                                    $author_id = $row['author'];

                                    $sql1 = "SELECT * FROM category WHERE category_id = $category_id ";
                                    $result1 = mysqli_query($conn, $sql1) or die("query failed");
                                    $catData = mysqli_fetch_assoc($result1);

                                    $sql2 = "SELECT * FROM user WHERE user_id = $author_id ";
                                    $result2 = mysqli_query($conn, $sql2) or die("query failed");
                                    $catData1 = mysqli_fetch_assoc($result2);

                                    $category_name = $catData['category_name'];
                                    $user_name = $catData1['username'];
                            ?>
                                    <div class="post-content">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a class="post-img" href="single.php?id<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt="" /></a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="inner-content clearfix">
                                                    <h3><a href='single.php?id<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                                    <div class="post-information">
                                                        <span>
                                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                                            <a href='category.php'><?php echo $category_name; ?></a>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                            <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $user_name; ?></a>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            <?php echo $row['post_date']; ?>
                                                        </span>
                                                    </div>
                                                    <p class="description">
                                                        <?php echo substr($row['description'], 0, 130) . "........"; ?> </p>
                                                    <a class='read-more pull-right' href='single.php?id<?php echo $row['post_id']; ?>'>read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "Record not founds";
                            }

                            ?>

                            <!-- /post-container -->
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'sidebar.php'; ?>
            <?php include 'footer.php'; ?>