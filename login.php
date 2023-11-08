<?php
if (isset($_GET['error'])) {

    $errorMessage = $_GET['error'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="form.css">
    <title>Login Form</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body style="font-family: Verdana;">
    <?php
    require_once("./components/navbar.php")

?>

  
<div class="container">
<form action="login_process.php" method="post">
        <h2>Login</h2>
        <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <div class="input-group">
          <label for="uname">Username</label>
          <input type="text" id="uname" name="uname" placeholder="Enter your username" required class="login-input" />
        </div>
        <div class="password-forgot">
  <label for="password">Password</label>
  <input type="password" id="password" name="password" placeholder="Enter your password" required class="login-input" />
  <div class="forgot-remember">
    <div class="left-side">
      
                    
                </div>
            </div>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="or-line">
            <span></span>
            <span class="or">or</span>
            <span></span>
        </div>

        <div class="signup-link">
            <p>Not a member yet? <a href="signup.php">Create new Account</a></p>
        </div>
    </form>
</div>

<?php
    require_once("./components/footer.php")
?>
</body>
</html>
