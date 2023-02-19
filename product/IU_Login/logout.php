<?php
session_start();
session_destroy();
// clear login and redirect to the login page:
header("refresh: 0; url = https://cgi.luddy.indiana.edu/~team63/IU_Login/officehourPlus.php");
?>