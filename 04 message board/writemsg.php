<?php
include './includes/session.php';
$pageTitle = 'Write Messages';

if (!isset($_SESSION['loggedIn'])) {
    header('Location: index.php');
    exit;
}

include './includes/header.php';
include './includes/stuff.php';
include './includes/db.php';

loggedInWelcomeMsg($sessionUser, $cssSpanOrange, $cssSpanEnd);


if ($_POST) {
    //normalizacia
    $msg = trim($_POST['msg']);
    $msg = mysqli_real_escape_string($connection, $msg);

    $error = '';
    //validacia
    if (mb_strlen($msg) < 5 || mb_strlen($msg) > 450) {
        echo '<p>Msg has to be between 5 and 450 characters</p>';
        $error = true;
    }
    
    //za da raboti now() - t.e. da ima i data i chas... triabva poleto na date
    //da e DATETIME
    if (!$error) {
        $sql = mysqli_query($connection, 'INSERT INTO comments 
                (user_name,comment,date) 
                VALUES ("' . $sessionUser . '","' . $msg . '",now())');

        if ($sql) {
            echo $cssSpanOrange . ' Good Job! Write another one!:)<br />' . $cssSpanEnd;
        } else {
            echo 'error';
            ifDebugMsqlError($debug, $connection);
        }
    }
}
?>

<br />
<form method="POST">
    <textarea name="msg"></textarea>
    <input type="submit" value="Add" />
</form>

<a href="inside.php">See All Messages</a>

<?php include './includes/footer.php'; ?>