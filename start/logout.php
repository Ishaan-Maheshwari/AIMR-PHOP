<?php
require_once('classes/Authenticate.php');
session_start();
Authenticate::logout();
header("Location: /start/index.php");
?>