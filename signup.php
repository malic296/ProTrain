<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ProTrain Registration</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles.css'>
    <script src='main.js'></script>
</head>
<body>
    <div class="signup">
        <h2>Register</h2>
        <form action="app.php" method="post" class = "form_signup">
            <div class="signup_uname"><input id="login" name="loginRegister" type="text" placeholder="username" class = "text"> </div>
            <div class="signup_email"><input id="email" name="emailRegister" type="text" placeholder="email" class = "text"> </div>
            <div class="signup_passwd"><input id="password" name="passwordRegister" type="password" placeholder="*********" class = "text"></div>
            <div class="signup_button"><input type="submit" value="Register" name="subReg" class = "submit"></div>
            <div class="signup_login">Already registered? <br><a href=" login.php"><input type="submit" value="Login" class = "submit_small"></a></div>
        </form>
    </div>
</body>
</html>