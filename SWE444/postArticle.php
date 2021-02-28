
<?php
include "config.php";

session_start();

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");

$artTitle = mysqli_real_escape_string($db, $_POST['artTitle']);
$artBody = mysqli_real_escape_string($db, $_POST['artBody']);
$authorB = mysqli_real_escape_string($db, $_POST['authorB']);

$username = $_SESSION["username"];



if (empty($artTitle)) {
    array_push($errors, "Title is required");
}
if (empty($artBody)) {
    array_push($errors, "Body is required");
}

$file_name = basename($_FILES['image']['name']);
$fileType = pathinfo($file_name, PATHINFO_EXTENSION);
$allowTypes = array('jpg', 'png', 'jpeg', 'gif');
$errors = array();

if (!in_array($fileType, $allowTypes)) {
    array_push($errors, "Image not supported ");
}
$image = $_FILES['image']['tmp_name'];
$imgContent = addslashes(file_get_contents($image));




if (count($errors) == 0) {


    $query = "INSERT INTO book(Seller_user,Title,description,img,state,author) VALUES('$username','$artTitle','$artBody','$imgContent','Saved','$authorB')";

    if (isset($_POST["update"])) {
       
        $artId = mysqli_real_escape_string($db, $_POST['articleId']);

        $query = "UPDATE book SET Title='$artTitle',description= '$artBody',img='$imgContent' WHERE article_id='$artId'";
    }
    $result = mysqli_query($db, $query);
    mysqli_close($db);

    header("location:journalistDashboard.php");
} else {
    
    error_reporting(E_ALL);
    header("location:journalistDashboard.php?error=1");

}
