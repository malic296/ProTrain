<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ProTrain Registration</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <script src='main.js'></script>
</head>
<body>
    <div class="box">
        <form action="app.php" method="post">
            <h2>Register</h2>
            <div class="logPage"><input id="login" name="loginRegister" type="text" placeholder="username"> </div>
            <div class="logPage"><input id="email" name="emailRegister" type="text" placeholder="email"> </div>
            <div class="logPage"><input id="password" name="passwordRegister" type="password" placeholder="******"></div>
            <div class="logPage"><input type="submit" value="Register" name="subReg"></div>
            <div class="logPage">Already registered? <a href=" login.php">Sign In</a></div>
        </form>
    </div>
</body>
</html>