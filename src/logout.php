<?php
session_start();

// To unset the username and logged in keys and then destroy the session
session_unset();
session_destroy();

header("Location: login.php");
exit();

?>