<?php
require_once __DIR__ . '/../negocio/Globales.php';
session_start();
unset($_SESSION['user']);
session_destroy();
header("Location: " . URL_BASE . "index.php");
exit;