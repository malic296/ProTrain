<?php
if($_SESSION["userExists"] = 0){
    echo "everything went smoohly";
}
else if($_SESSION["userExists"] = 1){
    echo "<h1>Username already exists, try again.</h1>";
    ?>
    <div class="profile"><i class= "fa-solid fa-circle-user profilePic"></i>
        <div class="uname"><span class = "prof1">Username : </span><span class = "prof2"><form method = "POST"  action = "profAlterValidation.php"><input required name = "unameAltered" type = "text" class = "input" placeholder = "<?php echo $username;?>"></form></span></div>
        <div class="password"><span class = "prof1">Password : </span><span class = "prof2"><form method = "POST"  action = "profAlterValidation.php"><input required name = "passwdAltered" type = "text" class = "input" placeholder = "********"></form></span></div>
        <div class="email"><span class = "prof1">E-mail : </span><span class = "prof2"><?php echo " ".$email;?></span></div>
        <form method = "POST" action = "profAlterValidation.php">
            <input type = "submit" class = "submitProf" name = "save" value = "Save">
        </form>   
    </div>


    <?php

}


?>