
<?php

if (!isset($_SESSION)) {
    session_start();
}

$lang = $_SESSION['abbr_lang'];
session_destroy();
$lang = $lang ?? "en";
$url = base_url();
header("Location:" . $url . $lang . "/connexion");
die();

?>