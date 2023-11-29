<?php include 'header.php';
include "config.php"; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                $cat_id = $_GET['cid'];
                $sql1 = "SELECT * FROM category WHERE category_id = {$cat_id}";
                $result1 = mysqli_query($conn, $sql1) or die("connection Failed : category Name");
                $row1 = mysqli_fetch_assoc($result1);
                ?>
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading"><?php echo $row1['category_name']; ?></h2>
                    <div class="post-container">
                        <?php
                        if (isset($_GET['cid'])) {
                            $cat_id = $_GET['cid'];
                        }
                        $sql = "SELECT * FROM post 
                 LEFT JOIN category  ON post.category = category.category_id
                 LEFT JOIN user ON post.author = user.user_id
                 WHERE  post.category = {$cat_id}
                  ORDER BY post.post_id DESC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
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
                                                        <a href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
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
                        <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>\
                            <li><a href="">3</a></li>
                        </ul>

                    </div>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>