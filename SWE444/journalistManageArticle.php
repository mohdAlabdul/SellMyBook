<?php
include "config.php";

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
$choice = $_REQUEST["choice"];
$articleId = $_REQUEST["articleId"];
$error = "0";
if ($choice == "delete") {
    $query = "DELETE FROM book WHERE book_id='" . $articleId . "'";
    $result = $db->query($query);
    if (mysqli_affected_rows($db) > 0) {
        $error = "0";
    } else {
        $error = "1";
    }
    header("location: BookDashboard.php?error=" . $error);
} else if ($choice == "edit") {
    header("location: writing.php?articleId=" . $articleId);
} else if ($choice == "publish") {
    $query = "UPDATE book SET state='Process' WHERE book_id='" . $articleId . "'";
    $result = $db->query($query);
    if (mysqli_affected_rows($db) > 0) {
        $error = "0";
    } else {
        $error = "1";
    }
    header("location: BookDashboard.php?error=" . $error);
}
