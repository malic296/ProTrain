<?php
if($_SESSION["CODE"] == $_POST["verificationCode"]){
    if(isset($_COOKIE[$_SESSION["cookieVer"]])){
        //variables
        $DBuserID = $_SESSION["userID"];
        include "DBconnection.php";
        $sql = "SELECT login from users where ID_users = $DBuserID;";
        $result = $connection->query($sql);
        $uname = $result->fetch_assoc();
        $username = $uname["login"];

        $sql = "SELECT email from users where ID_users = $DBuserID;";
        $result = $connection->query($sql);
        $mail = $result->fetch_assoc();
        $email = $mail["email"];

        $sql = "SELECT password from users where ID_users = $DBuserID;";
        $result = $connection->query($sql);
        $passwd = $result->fetch_assoc();
        $password = $passwd["password"];
        $connection->close();
        //variables $password, $email, $username
        ?>
        <div class="profile"><i class= "fa-solid fa-circle-user profilePic"></i>
            <form method = "POST">
                <div class="uname"><span class = "prof1">Username : </span><span class = "prof2"><input required name = "unameAltered" type = "text" class = "input" placeholder = "<?php echo $username;?>"></span></div>
                <div class="password"><span class = "prof1">Password : </span><span class = "prof2"><input required name = "passwdAltered" type = "text" class = "input" placeholder = "********"></span></div>
                <div class="email"><span class = "prof1">E-mail : </span><span class = "prof2"><?php echo " ".$email;?></span></div>
           
                <input type = "submit" class = "submitProf" name = "save" value = "Save">
            </form>   
        </div>


        <?php
    }
    else{
        
        header("Location:app.php");
    }
}
else{
    echo '<script type="text/javascript">
         window.onload = function () { alert("Incorrect code"); } 
        </script>';
    //header("Location:app.php");
}
?>