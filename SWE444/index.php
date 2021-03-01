<?php include "config.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">


<head>
<style>
@import url(//fonts.googleapis.com/css?family=Lato:300:400);

body {
  margin:0;
}

h1 {
  font-family: 'Lato', sans-serif;
  font-weight:300;
  letter-spacing: 2px;
  font-size:48px;
}
p {
  font-family: 'Lato', sans-serif;
  letter-spacing: 1px;
  font-size:14px;
  color: #333333;
}

.header {
  position:relative;
  text-align:center;
  background: linear-gradient(60deg, rgba(84,58,183,1) 0%, rgba(0,172,193,1) 100%);
  color:white;
}
.logo {
  width:50px;
  fill:white;
  padding-right:15px;
  display:inline-block;
  vertical-align: middle;
}

.inner-header {
  height:65vh;
  width:100%;
  margin: 0;
  padding: 0;
}

.flex { /*Flexbox for containers*/
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.waves {
  position:relative;
  width: 100%;
  height:15vh;
  margin-bottom:-7px; /*Fix for safari gap*/
  min-height:100px;
  max-height:150px;
}

.content {
  position:relative;
  height:20vh;
  text-align:center;
  background-color: white;
}

/* Animation */

.parallax > use {
  animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
}
.parallax > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.parallax > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.parallax > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.parallax > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes move-forever {
  0% {
   transform: translate3d(-90px,0,0);
  }
  100% { 
    transform: translate3d(85px,0,0);
  }
}
/*Shrinking for mobile*/
@media (max-width: 768px) {
  .waves {
    height:40px;
    min-height:40px;
  }
  .content {
    height:30vh;
  }
  h1 {
    font-size:24px;
  }
}

</style>
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

    
    <div class="header">

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
        $query = "SELECT * FROM book ";
        if (isset($_REQUEST["search"])) {
            $query = "SELECT * FROM Article  AND title LIKE '%" . $_REQUEST["search"] . "%'";
        }
        $result = $db->query($query);

    


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<a class="maincardhover" href="articleDetails.php?articleId=' . $row["book_id"] . '" >
                <div class="photo-card" style="height:250px;" >
                <img class="photo-background" src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['img']) . '"  class="card-img-top" alt="...">

                    <div class="photo-details" style="text-align: left;">
                        <h1 style="color: rgb(0,0,0);" >' . $row["Title"] . '</h1>
                        <p>Author: '.$row["author"].'</p>
                        <p>' . strip_tags(substr($row["description"], 0, 100)) . '....</p>
                        <span style="color:red">Sold by:</span>
                        <span><b>@'.$row["Seller_user"].'</b></span>
                        
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


<!--Waves Container-->
<div>
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
<defs>
<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
</defs>
<g class="parallax">
<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
</g>
</svg>
</div>
<!--Waves end-->

</div>
</body>

</html>