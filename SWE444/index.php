<?php include "config.php";
session_start();
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
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
    <script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
    <script>
        function search() {
            let keyword = $("#search-field").val();
            window.location.href = "index.php?search=" + keyword;

        }
    </script>

</head>

<body>

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
        $query = "SELECT * FROM book  INNER JOIN user ON book.Seller_user = user.username WHERE user.is_enabled = '1' ";
        if (isset($_REQUEST["search"])) {
            $query = "SELECT * FROM book WHERE Title LIKE '%".$_REQUEST["search"]."%' ";
        }
        $result = $db->query($query);




        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<a class="maincardhover" href="articleDetails.php?articleId=' . $row["book_id"] . '" >
                <div class="photo-card " style="height:250px;" >
                <img class="photo-background" src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['img']) . '"  class="card-img-top" alt="...">
                    <div class="photo-details" style="text-align:left;">
                        <h1 style="color: rgb(0,0,0); margin-right: 5px;" >' . strip_tags(substr($row["Title"], 0,25)) . '..</h1>
                       
                        <p class="warpText">' . strip_tags(substr($row["description"], 0,25)) . '....</p>
                        <p type ="number" class="price-tag">Price: '.$row["price"].'SAR</p>
                        <span class = "seller">Sold by: @'.$row["Seller_user"].'</span>

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
