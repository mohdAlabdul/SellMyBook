<?php
session_start();

if ($_SESSION["role"] == "admin") {
    header("location: editorDashboard.php");
} else if ($_SESSION["role"] == "user") {
    header("location: journalistDashboard.php");
} else {
    header("location: index.php");
}
