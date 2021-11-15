<?php
session_start();

// remove all session variables
unset($_SESSION['elogid']);
unset($_SESSION['type']);
unset($_SESSION['status']);

header('location:index.php?msg=success_logout');
?>