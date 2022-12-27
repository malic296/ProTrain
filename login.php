<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>DB testing</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Lobster&display=swap" rel="stylesheet">
    <script src='main.js'></script>
</head>
<body>
    <div class="head">
        <header>ProTrain</header>
    </div>
    <div class="login">
        
            <div class="login_signup">
                <div class="login_choose">
                    <a href="login.php"><input type="submit" value="Login" class = "current_page"></a>
                </div>
                <div class="signup_choose">
                    <a href="signup.php"><input type="submit" value="Sign Up" class = "choosing_but"></a>
                </div>
    
            </div>
        <form action="app.php" method="post" class = form_login>   
            <div class="login_texty">  
                
                    <div class="login_uname"><input type="text" id = "login" name="login" class = "text"> 
                        <label for = "login" class = "label_uname"><span class = "content_uname">Username:</span></label>
                    </div>
                

        
                    <div class="login_passwd"><input type="password" id = "password" name="password" class = "text"> 
                        <label for = "password" class = "label_passwd"><span class = "content_passwd">Password:</span></label>
                    </div>   
            </div>   
            <div class="login_konec">            
                <div class="login_button"><input type="submit" name="subLogin" id="" value="Login" class = "submit"></div>
            </div>
        </form>  
    </div>  
</body>
</html>