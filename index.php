<?php
session_start();
$loginLink = "login.php";
$signUpLink = "signup.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$logged_in_user = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$sql_posts = "SELECT posts.id, posts.description, posts.image, posts.uploaded_by, posts.player_name, posts.created_at, users.fullname 
              FROM posts
              JOIN users ON posts.uploaded_by = users.username
              WHERE posts.uploaded_by != '$logged_in_user' 
              ORDER BY posts.created_at DESC";

$result_posts = $conn->query($sql_posts);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body style="font-family: Verdana; ">

    <!-- Navbar -->
    <?php
    require_once('./components/navbar.php');
    ?>


    <!-- main area -->


    <div class="min-h-screen">
        <?php if (!isset($_SESSION['user_id'])) : ?>
            <div class="containers w-full">
                <div data-am-gallery>
                    <!-- Radio -->
                    <input type="radio" name="gallery" id="img-1" checked />
                    <input type="radio" name="gallery" id="img-2" />
                    <input type="radio" name="gallery" id="img-3" />

                    <!-- Images -->
                    <div class="images">
                        <div class="image" style="background-image: url(https://th.bing.com/th/id/OIP.4C1KmO7co8CLnp46GUd7XgHaEo?pid=ImgDet&rs=1);"></div>
                        <div class="image" style="background-image: url(https://th.bing.com/th/id/R.dcfaa4e0d05802dad110c34575e506fd?rik=tStvHjZngQPg4Q&pid=ImgRaw&r=0);"></div>
                        <div class="image" style="background-image: url(https://wallpapercave.com/wp/wp2356048.jpg);"></div>
                    </div>

                    <!-- Navigation -->
                    <div class="navigation">
                        <label class="dot" for="img-1"></label>
                        <label class="dot" for="img-2"></label>
                        <label class="dot" for="img-3"></label>
                    </div>

                </div>
            </div>

            <?php
            require_once('./components/features.php');
            ?>

        <?php else : ?>
            <?php include('./components/loggedHome.php'); ?>
        <?php endif; ?>
    </div>

    <!-- footer -->
    <?php
    require_once('./components/footer.php');
    ?>


</body>

<script>
    // Burger menus
    document.addEventListener('DOMContentLoaded', function() {
        // open
        const burger = document.querySelectorAll('.navbar-burger');
        const menu = document.querySelectorAll('.navbar-menu');

        if (burger.length && menu.length) {
            for (var i = 0; i < burger.length; i++) {
                burger[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }

        // close
        const close = document.querySelectorAll('.navbar-close');
        const backdrop = document.querySelectorAll('.navbar-backdrop');

        if (close.length) {
            for (var i = 0; i < close.length; i++) {
                close[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }

        if (backdrop.length) {
            for (var i = 0; i < backdrop.length; i++) {
                backdrop[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }
    });
</script>



</html>