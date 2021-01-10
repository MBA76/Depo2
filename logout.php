<?php
session_start();
session_destroy();
session_unset();
unset($_SESSION['kadi']);
header("Location:index.php");
?>