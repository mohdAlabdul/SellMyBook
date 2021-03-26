<?php
include "config.php";
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
$username = mysqli_real_escape_string($db, $_POST['username']);
$operation = mysqli_real_escape_string($db, $_POST['operation']);
$error = "0";
$query = "UPDATE user SET is_enabled='$operation' WHERE username='$username'";
$result = mysqli_query($db, $query);
if (mysqli_affected_rows($db) > 0) {
    $error = "0";
} else {
    $error = "1";
}
mysqli_close($db);

header("location:editorDashboard.php?error=" . $error);
