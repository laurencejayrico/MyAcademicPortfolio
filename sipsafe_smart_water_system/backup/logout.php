<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the login or front page
header("Location: index.php");
exit();
?>
