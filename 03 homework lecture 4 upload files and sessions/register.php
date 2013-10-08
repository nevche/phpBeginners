<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Register';
require('./includes/header.php');
?>

<br /><br />
<a href="index.php">Back to Login</a>
<br /><br />

<?php
if ($_POST) {
    //normalizacia
    $registerUsername = trim($_POST['registerUsername']);
    $registerUsername = str_replace($separator, $emptyStr, $registerUsername);

    $registerPassword = trim($_POST['registerPassword']);
    $registerPassword = str_replace($separator, $emptyStr, $registerPassword);

    $error = false;

    //validacia
    if (mb_strlen($registerUsername) < 3 || mb_strlen($registerUsername) > 10) {
        echo '<p>Username is too short or too long </p>';
        $error = true;

        if (!is_string($registerUsername)) {
            echo '<p>Username has to include letters</p>';
            $error = true;
        }
    }
    
    if (mb_strlen($registerPassword) < 3 || mb_strlen($registerPassword) > 15) {
        echo '<p>Password is too short or too long</p>';
        $error = true;
    }
   
    //check if username already exists
    //foreach se povtaria s dr.ia fail... da se popravi...:)
    //function

    $passFile = file('./includes/passwords.txt');

    foreach ($passFile as $key => $value) {
        $loginInfo = explode($separator, $value);

        if (trim($loginInfo[0]) == $registerUsername) {
            echo 'Username already exists. Choose a cooler one :)<br /><br />';
            $error = true;
            break;
        }
    }
    
    
    
    if (!$error) {
        $result = $registerUsername . $separator . $registerPassword . "\n";

        if (file_put_contents('./includes/passwords.txt', $result, FILE_APPEND)) {
            echo 'You registered successfully!<br /><br/>';
            exit;
        }
    }
}
?>


<form method="POST">
    <div><input type="text" name="registerUsername"></div>
    <div><input type="password" name="registerPassword"></div>
    <div><input type="submit" value="Register"></div>
</form>




<?php

include('./includes/footer.php');

?>