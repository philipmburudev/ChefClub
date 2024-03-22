<?php
session_start();
session_unset();
session_destroy();
header("Location: sigin_view.php");
exit;
?>