<?php

$debug = false;

mb_internal_encoding('UTF-8');


//css stuff
$cssSpan = '<span class="';
$cssSpanMid = '">';
$cssSpanEnd = '</span>';
$cssSpanOrange = '<span class="orange">';
$cssSpanRed = '<span class="red">';
$cssSpanGreen = '<span style="color:green;">';


//Debug + mysqli error
function ifDebugMsqlError($debug, $connection) {
    if ($debug) {
        echo mysqli_errno($connection);
        echo 'lalala';
        return;
    }
}
//


//Welcome Msg
if (isset($_SESSION['username'])) {
    $sessionUser = $_SESSION['username'];
}

function loggedInWelcomeMsg($sessionUser, $cssSpanOrange, $cssSpanEnd) {
    echo '<div>Hey ' . $cssSpanOrange . $_SESSION['username'] . $cssSpanEnd
    . '. You are now Logged In. Congratulations:P</div>';
    echo '<div>You could also 
            <a href="logout.php">Log Out</a> 
            if you\'d like...:(</div>';
}
//


?>