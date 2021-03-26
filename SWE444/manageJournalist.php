<?php
include "config.php";

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
$username = $_REQUEST["username"];
$option = $_REQUEST["enable"];
$query = "UPDATE User SET is_enabled='" . $option . "' WHERE username='" . $username . "'";
$qRes = mysqli_query($db, $query);
$error = "0";
if (mysqli_affected_rows($db) > 0) {
    $error = "0";
} else {
    $error = "1";
}
mysqli_close($db);

header("location: editorDashboard.php?error=" . $error);
