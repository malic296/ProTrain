<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ProTrain Registration</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles.css'>
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Lobster&display=swap" rel="stylesheet">
    <script src='main.js'></script>
</head>
<body>
    <div class="head">
        <header>ProTrain</header>
    </div>

    <?php
        if (isset($_GET["error"])) {
            echo "<div class='incorrect'>";
            echo "This username is already taken";
            echo "</div>";
        }
        
    ?>

    <div class="signup">
            <div class="login_signup">
                <div class="login_choose">
                    <a href="index.php"><input type="submit" value="Login" class = "choosing_but"></a>
                </div>
                <div class="signup_choose">
                    <a href="signup.php"><input type="submit" value="Sign Up" class = "current_page"></a>
                </div>
            </div>
        <form action="regValidation.php" method="post" class = "form_signup">
            <div class="signup_texty">
                    <label for="login" class = "signup_label_uname"><span class = "signup_username">Username:</span></label>
                <div class="signup_uname"><input id="login" name="loginRegister" type="text" class = "text" required> </div>
                    <label for="email" class = "signup_label_email"><span class = "signup_email_span">E-mail:</span></label>
                <div class="signup_email"><input id="email" name="emailRegister" type="text" class = "text" required> </div>
                    <label for="password" class = "signup_label_passwd"><span class = "signup-password">Password:</span></label>
                <div class="signup_passwd"><input id="password" name="passwordRegister" type="password" class = "text" required></div>
            </div>
            <div class="signup_konec">
                <div class="signup_button"><input type="submit" value="Sign Up" name="subReg" class = "submit"></div>
            </div>
        </form>
    </div>
    <?php
    $_SESSION["animace"] = 1;
    $_SESSION["animace2"] = 1;
    ?>
</body>
</html>