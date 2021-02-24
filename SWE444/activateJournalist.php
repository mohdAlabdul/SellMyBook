<?php
include "config.php";
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
$username = mysqli_real_escape_string($db, $_POST['username']);
$error = "0";
$query = "UPDATE User SET is_first_time='0',is_enabled='1' WHERE username='$username'";
$result = mysqli_query($db, $query);
if (mysqli_affected_rows($db) > 0) {
    $error = "0";
} else {
    $error = "1";
}
mysqli_close($db);

header("location:editorDashboard.php?error=" . $error);
