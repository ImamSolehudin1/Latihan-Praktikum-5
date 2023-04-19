<?php
if (isset($_GET['mod'])) {
    $mod = $_GET['mod'];
    switch ($mod) {
        case "home":
            require("home.php");
            break;
        case "about":
            require("about.php"); // perbaikan: tambahkan ekstensi file ".php"
            break;
        case "kontak":
            require("kontak.php"); // perbaikan: tambahkan ekstensi file ".php"
            break;
        default:
            require("home.php");
    }
} else {
    require("home.php");
}
