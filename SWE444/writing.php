<?php include "config.php";
session_start();
include "checkJournalistSignedIn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SellMyBook</title>
    <link rel="icon" href="assets/img/webIcon.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/dh-card-image-left-dark.css">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
</head>

<style>


</style>



<body style="box-shadow: 0px 0px;">
    <?php include "header.php"; ?>

    <?php
    if (isset($_REQUEST["articleId"])) {
        $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
        $articleId = $_REQUEST["articleId"];
        $query = "SELECT * FROM book WHERE book_id='" . $articleId . "'";
        $result = $db->query($query);
        $article;
        if ($result) {

            $article = $result->fetch_assoc();
        }



        echo '  
          <form action="postArticle.php" method="post" enctype="multipart/form-data" >
        <p class="text-center" style="margin: 20px 0px 0px 0px;">Title of the book&nbsp;</p>
        <input class="form-control" value="' . $article["Title"] . '" type="text" placeholder="Title" name="artTitle" style="margin: 20px 40%;width: 277px;border-style: solid;border-radius: 10px;padding: 0px 10px;">
        <p class="text-center">Add Cover image For your Book</p>


        <div class="edit-space">
            <input type="file" name="image" value="" required> 
            <img style="width:50%; height:20%; margin:15px;" src="data:image/jpg;charset=utf8;base64,' . base64_encode($article['img']) . '" class="card-img-top" alt="...">
            <textarea style="height: 50%;" id="editor" name="artBody" placeholder="Your article goes here">' . str_replace('&', '&amp;', $article["description"]) . '</textarea>
            <button class="btn btn-primary" id="save-btn" type="submit" style="margin: 10px 0px;" name="update" value="Save">Save</button>
            <input type="hidden" id="custId" name="articleId" value="' . $articleId . '">

        </div>

    </form>';
    } else {
        echo '    
        <form action="postArticle.php" method="post" enctype="multipart/form-data" >
        <p class="text-center" style="margin: 20px 0px 0px 0px;">Title of the book&nbsp;</p>
        <input class="form-control" type="text" placeholder="Title" name="artTitle" style="margin: 20px 40%;width: 277px;border-style: solid;border-radius: 10px;padding: 0px 10px;">
        <p class="text-center">Add Cover image For your book</p>
        <div class="edit-space">
            <input type="file" name="image" required>
            <img class="img-fluid" style="margin-bottom: 10px;" id="img-prev" src="">
            <textarea style="height: 50%;"  name="artBody" placeholder="Your description goes here" ></textarea>
            <button class="btn btn-primary" id="save-btn" type="submit" style="margin: 10px 0px;" name="save" value="Save">Save</button>
        </div>

    </form>';
    }
    ?>






</body>


</html>