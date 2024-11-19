<?php
session_start();
// if (!isset($_SESSION["username"]) && !isset($_SESSION["id"])) {
// } else {
    header("Location: admin/index.php");
// }