<?php

//logout...

//za da unishojim sesiata triabva purvo da ia pochnem...
session_start();
session_destroy();

//go to a page yeah; and stop doing anything else here.

header("Location: index.php");
exit;


?>
