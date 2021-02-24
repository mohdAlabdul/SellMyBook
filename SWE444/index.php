<?php include "config.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>VBooks</title>
    <link rel="icon" href="assets/img/webIcon.jpg">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
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
    <script src="jquery-3.5.1.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
    <script>
        function search() {
            let keyword = $("#search-field").val();
            window.location.href = "index.php?search=" + keyword;

        }
    </script>

</head>

<body>
/* Test github on ttt */
    <?php include "header.php"; ?>

    <section style="margin-top: 10px;">
        <h1 style="margin: 30% 10% 10% 10%;padding-left: 46px; display:inline;" class="text-3xl">Books</h1>
        <div class="input-group" style="width: 40%; margin: 10px 10%;padding-left: 46px;">
            <input type="text" id="search-field" class="form-control" placeholder="Search" <?php if (isset($_REQUEST["search"])) {
                                                                                                echo 'value="' . $_REQUEST["search"] . '"';
                                                                                            } ?>>
            <div class="input-group-append">
                <button class="btn btn-secondary" type="button" onclick="search();" onkeyup="search();">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>


        <div class="container text-center">
            <?php
            $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
            $query = "SELECT * FROM Article Where state='Published'";
            if (isset($_REQUEST["search"])) {
                $query = "SELECT * FROM Article Where state='Published' AND title LIKE '%" . $_REQUEST["search"] . "%'";
            }
            $result = $db->query($query);


            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<a class="maincardhover" href="articleDetails.php?articleId=' . $row["article_id"] . '" >
                    <div class="photo-card" style="height:250px;" >
                    <img class="photo-background" src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['cover_image']) . '"  class="card-img-top" alt="...">

                        <div class="photo-details" style="text-align: left;">
                            <h1 style="color: rgb(0,0,0);" >' . $row["title"] . '</h1>
                            <p>' . strip_tags(substr($row["body"], 0, 100)) . '....</p>
                        </div>
                    </div>
                </a>';
                }
            } else {
                echo "<h2>No Books for sale</h2>";
            }


            ?>


        </div>

    </section>

</body>

</html>