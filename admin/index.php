<?php
include "config.php";

if (isset($_SESSION['username'])) {
    header("Location:" . $REDIRECT_URL_AFTER_LOGIN);
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading" style="text-align: center;">Admin</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <div>
                            <input style="display: block; margin: auto; padding: 10px" type="submit" name="login" class="btn btn-primary" value="Login" />
                        </div>
                    </form>
                    <!-- /Form  End -->
                    <?php
                    if (isset($_POST['login'])) {
                        $username = mysqli_escape_string($conn, $_POST['username']);
                        $password = md5($_POST['password']);
                        $sql = "SELECT user_id, username, role FROM user WHERE username = '{$username}' AND password = '{$password}'";
                        $result = mysqli_query($conn, $sql) or die("connection failed.");
                        if (mysqli_num_rows($result) > 0) {

                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['role'] = $row['role'];
                            header("Location:http://localhost/news-template/admin/users.php");
                        } else {
                            echo "<p style='text-align:center; color:red'>User name or Password does not match</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>