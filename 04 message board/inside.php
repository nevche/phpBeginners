<?php

include './includes/session.php';
$pageTitle = 'All Messages';

if (!isset($_SESSION['loggedIn'])) {
    header('Location: index.php');
    exit;
}

include './includes/header.php';
include './includes/stuff.php';
include './includes/db.php';

loggedInWelcomeMsg($sessionUser, $cssSpanOrange, $cssSpanEnd);

//da si vzmeme msg-tata i da si gi pokajem i nai-skoroshnite da sa nai-gore
$q = mysqli_query($connection, 'SELECT user_name,comment,date 
            FROM comments 
            ORDER BY date DESC LIMIT 0,100');

if ($q->num_rows > 0) {


    echo '<br /><br /><table><tr><td>
            All the Messages :)</td>
            <td align="right" colspan="2">
            <a href="writemsg.php">Add a new one here!</a>
            </td></tr>
            <tr><td height="15px" colspan="3"><hr></td></tr>';

    while ($row = $q->fetch_assoc()) {
        echo '<tr><td>' . $cssSpanOrange . $row['user_name'] . $cssSpanEnd . '</td><td width="10"></td>
                <td align="right">' . $cssSpanGreen . $row['date'] . $cssSpanEnd . '</td></tr><tr>
                <td colspan="3">' . $row['comment'] . '</td></tr>';

        if ($sessionUser == 'admin') {
            //Figure out    

            echo '<tr><td colspan="3" align="right">' . $cssSpanRed . 'Delete Msg'
            . $cssSpanEnd;
        }

        echo '<tr><td height="15px" colspan="3"></td></tr>
                <tr><td height="15px" colspan="3"><hr></td></tr>';
    }

    echo '</table>';
} else {
    echo 'no results';
}

if (!$q) {
    echo 'error';

    if ($debug) {
        echo mysqli_errno($link);
    }
}

include './includes/footer.php';
?>