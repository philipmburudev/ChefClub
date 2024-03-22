<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: signin_view.php'); // Redirect to login page
    exit;
}
?>