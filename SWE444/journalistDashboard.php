<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "checkJournalistSignedIn.php";
?>

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
    <link rel="stylesheet" href="assets/css/controlcss.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="fancyTooltip.css">

    <script>
        function search() {
            let keyword = $("#search-field").val();
            window.location.href = "journalistDashboard.php?search=" + keyword;

        }

        function showConfirm(message) {
            let res = confirm(message);
            return res;

        }
    </script>
    <style>
        .left {

            position: relative;
            left: 0;

        }

        .right {

            position: relative;
            right: 0;

        }
    </style>

</head>

<body>

    <?php include "header.php"; ?>
    <?php
    if (isset($_REQUEST["error"])) {
        if ($_REQUEST["error"] == "0") {
            echo '<div class="alert alert-success" role="alert">
           Operation succeeded
        </div>';
        } else {
            echo '  <div class="alert alert-danger" role="alert">
        Opreation Failed. Please try again later
</div>';
        }
    }

    ?>
    <div class="row">
        <div class="col-sm-1">
            <h2 class="text-3xl" style="margin: 10px;margin-top: 20px;">Books</h2>

        </div>
        <div class="col-sm-11">
            <button type="button" onclick="window.location.href='writing.php'" style="margin-left:15px; margin-top: 20px;" class="btn btn-dark">Add Book</button>

        </div>
    </div>

    <div class="input-group" style="width: 40%; margin: 10px;">
        <input type="text" id="search-field" class="form-control" placeholder="Search" <?php if (isset($_REQUEST["search"])) {
                                                                                            echo 'value="' . $_REQUEST["search"] . '"';
                                                                                        } ?>>
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button" onclick="search();" onkeyup="search();">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4">
        <?php
        include "config.php";
        $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
        $publichedOrProcessQuery = "SELECT * FROM book Where Seller_user='" . $_SESSION["username"]."'";
        $notedQuery = "SELECT * FROM book Where Seller_user='" . $_SESSION["username"].  "'";
        $savedQuery = "SELECT * FROM book Where Seller_user='" . $_SESSION["username"]. "'";
        if (isset($_REQUEST["search"])) {
            $keyword = $_REQUEST["search"];
            $link = " AND Title LIKE '%" . $keyword . "%' ";
            $publichedOrProcessQuery = "SELECT * FROM book Where Seller_user='" . $_SESSION["username"]. "'" . $link;
            $notedQuery = "SELECT * FROM book Where Seller_user='" . $_SESSION["username"]. "'" . $link;
            "SELECT * FROM book Where writer_username='" . $_SESSION["username"] . "'" . $link;

            $savedQuery = "SELECT * FROM book Where Seller_user='" . $_SESSION["username"] . "'"  . $link;
        }
        $result1 = $db->query($publichedOrProcessQuery);
        $notedResult = $db->query($notedQuery);
        $savedResult = $db->query($savedQuery);
        if ($result1->num_rows > 0 || $notedResult->num_rows > 0 || $savedResult->num_rows > 0) {
           
            while ($row = $savedResult->fetch_assoc()) {
                $link = "journalistManageArticle.php?articleId=" . $row["book_id"] . "&choice=";
                echo '<div class="col mb-3" >
                     <div class="card cardHover shadow-md" >
                    <img src="data:image/jpg;base64,' . base64_encode($row['img']) . '"  style="height:189px; width:275px;" class="card-img-top" alt="...">
                    <div class="card-body"  style="height:210px;">
                        <h5 class="card-title">' . $row["Title"] . '</h5>
                        
                        <hr>
                        <h6 class="card-title" style="color:#3377FF;">' . "Sent" . '</h6>
                        <button onclick=" window.location.href = \' articleDetails.php?articleId=' . $row["book_id"] . ';\'" type="button" class="btn btn-outline-primary">Open</button>
                        <button onclick="window.location.href=\'' . $link . 'edit\'" type="button" class="btn btn-outline-secondary"><svg width="1em" height="23px" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg></button>
                        <button  onclick="if(showConfirm(\'Are you sure you want to delete ? \'))  window.location.href=\'' . $link . 'delete\'"  type="button" class="btn btn-outline-danger"><svg width="1em" height="23px" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg></button>
                    </div>
                </div>         </div>
                ';
            }
           
        } else {
            echo "<h5 style='margin:20px;'>No Books</h5>";
        }

        ?>


    </div>


</body>

</html>