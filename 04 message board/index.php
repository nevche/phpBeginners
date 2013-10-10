<?php
include './includes/session.php';
$pageTitle = 'Log In';
include './includes/stuff.php';
include './includes/db.php';

//niakoi napisal li e neshto
if ($_POST) {
    $username = trim($_POST['username']);
    $pass = trim($_POST['pass']);
    $wrongpass = TRUE;

    //da si potursim queryto
    $userQ = mysqli_query($connection, 'SELECT user_id,user_name,user_password 
            FROM user_login');

    //ako ne raboti - greshka.
    if (!$userQ) {
        echo 'error';
        ifDebugMsqlError($debug, $connection);
    }

    //dokato rowovete sa poveche ot 0-la...proveriavai
    if ($userQ->num_rows > 0) {
        while ($row = $userQ->fetch_assoc()) {
            if ($username == $row['user_name'] && $pass == $row['user_password']) {
                //prati variables za sessiata
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $username;
                header('Location: inside.php');
                exit;
            }
        }
    }

    include './includes/header.php';

    if ($wrongpass == true) {
        echo $cssSpan . 'red' . $cssSpanMid . 'Wrong Username or Password' . $cssSpanEnd;
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


<?php include './includes/footer.php'; ?>