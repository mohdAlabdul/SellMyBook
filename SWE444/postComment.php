<?php
include "config.php";

session_start();

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
$comment = mysqli_real_escape_string($db, $_POST['comment']);
$articleId = mysqli_real_escape_string($db, $_POST['articleId']);
$username = $_SESSION["username"];



$query = "INSERT INTO comment(article_id,comment_username,comment) VALUES('$articleId','$username','$comment')";
$result = mysqli_query($db, $query);
mysqli_close($db);

if ($result) {
    header("location:articleDetails.php?articleId=" . $_POST['articleId'] . "&message=Thank you for your comment");
} else {
   
   header("location:articleDetails.php?bookId=" . $_POST['articleId'] . "&message=An error occur while posting your comment");
}
