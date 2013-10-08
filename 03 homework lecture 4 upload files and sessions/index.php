<?php
include('./includes/header.php');
$pageTitle = 'Login';

$trueLogin = FALSE;
$contents = '';
// this checks if login is correct..

if (isset($_SESSION['loggedIn']) == TRUE) {
    echo 'You are no Logged In. Congratulations:P';
    echo '<div>You could also 
            <a href="logout.php">Log Out</a> 
            if you\'d like...:(';
} else {

    if ($_POST) {
        $username = trim($_POST['username']);
        $pass = trim($_POST['pass']);


        $passFile = file('./includes/passwords.txt');

        foreach ($passFile as $key => $value) {
            $loginInfo = explode($separator, $value);

            if ((trim($loginInfo[0]) == $username) && (trim($loginInfo[1]) == $pass)) {
                $trueLogin = TRUE;
                break;
            }
        }

        if ($trueLogin == true) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['userFolder'] = $username;


            header('Location: inside.php');
            exit;
        } else {
            echo '<span style="color:red;">Wrong Username or Password</span>';
        }
    }
    ?>
    <br /><br />
    
    <form  method="POST">
        <div>Username:<input type="text" name="username"></div>
        <div>Password:<input type="password" name="pass"></div>
        <div><input type="submit" value="Log In"> 
         or <a href="register.php">Register</a>
        </div>
    </form>

<?php } ?>

<?php include('./includes/footer.php'); ?>