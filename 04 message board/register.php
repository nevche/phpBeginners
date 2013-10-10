<?php
include './includes/session.php';
$pageTitle = 'Register';

include './includes/header.php';
include './includes/stuff.php';
include './includes/db.php';


if ($_POST) {
    //normalizacia
    $registerUsername = trim($_POST['registerUsername']);
    $registerUsername = mysqli_real_escape_string($connection, $registerUsername);

    $registerPassword = trim($_POST['registerPassword']);
    $registerPassword = mysqli_real_escape_string($connection, $registerPassword);

    $error = '';

    //validacia
    if (mb_strlen($registerUsername) < 5 || mb_strlen($registerUsername) > 20) {
        echo '<p>Username is too short or too long </p>';
        $error = true;

        if (!is_string($registerUsername)) {
            echo '<p>Username has to include letters</p>';
            $error = true;
        }
    }

    if (mb_strlen($registerPassword) < 5 || mb_strlen($registerPassword) > 20) {
        echo '<p>Password is too short or too long</p>';
        $error = true;
    }

    //check if username already exists
    //da si potursim queryto
    $userQ = mysqli_query($connection, 'SELECT user_name 
            FROM user_login');

    //ako ne raboti - greshka.
    if (!$userQ) {
        echo 'error';
        ifDebugMsqlError($debug, $connection);
    }

    //dokato rowovete sa poveche ot 0-la...proveriavai
    if ($userQ->num_rows > 0) {
        while ($row = $userQ->fetch_assoc()) {
            if ($registerUsername == $row['user_name']) {
                echo 'Username already exists. Choose a cooler one.';
                $error = true;
                break;
            }
        }
    }

    if (!$error) {
        $sql = mysqli_query($connection, 'INSERT INTO user_login 
                (user_name,user_password) 
                VALUES ("' . $registerUsername . '","' . $registerPassword . '")');

        if ($sql) {
            echo $cssSpanOrange . ' Good Job!' . $cssSpanEnd;
        } else {
            echo 'error';
            ifDebugMsqlError($debug, $connection);
        }
    }
}
?>

<br /><br />
<a href="index.php">Back to Login</a>
<br /><br />

<form method="POST">
    <div><input type="text" name="registerUsername"></div>
    <div><input type="password" name="registerPassword"></div>
    <div><input type="submit" value="Register"></div>
</form>


<?php include './includes/footer.php'; ?>