<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_SESSION['user_name'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $foodName = $_POST['player_name']; // Added line for food name
    $description = $_POST['description'];
    $uploadedBy = $_SESSION['user_name'];
    $targetDir = "postspic/";

    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        $insertQuery = "INSERT INTO posts (description, image, uploaded_by, player_name) VALUES ('$description', '$fileName', '$uploadedBy', '$foodName')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: userdashboard.php?success=Post uploaded successfully!");
            exit();
        } else {
            header("Location: userdashboard.php?error=Error uploading post.");
            exit();
        }
    } else {
        header("Location: userdashboard.php?error=Error moving uploaded file.");
        exit();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload a Post</title>
    <link rel="stylesheet" href="styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body style="font-family: Verdana; ">

    <!-- Navbar -->
    <?php
    require_once('./components/navbar.php');
    ?>


    <main class="container">
        <section class="content">
            <div class="post-upload-box">
                <h2>Upload a Post</h2>
                <?php if(isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <form action="post-upload.php" method="post" enctype="multipart/form-data" class="post-upload-form">
                    <label for="image">Image (553x330px):</label>
                    <input type="file" name="image" id="image" accept="image/*" required>

                    <label for="player_name">PlayerName:</label>
                    <input type="text" name="player_name" id="player_name" required>

                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="4" required></textarea>

                    <button type="submit">Upload Post</button>
                </form>
            </div>
        </section>
    </main>

   <?php
    require_once('./components/footer.php');
    ?>
</body>
</html>
