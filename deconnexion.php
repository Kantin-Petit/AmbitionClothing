<?php
session_start();

session_destroy();
header('Location: Mon%20compte.php');
exit;

?>