<?php
//connect
$connection = mysqli_connect('localhost', 'nevche', 'swank', '02_comments');
//check for connection
if (!$connection) {
    echo 'No database';
    ifDebugMsqlError($debug);
    exit;
} else {
    echo '<span class="orange">Connected</span>';
}
//utf-8
mysqli_set_charset($connection, 'uft8');
?>