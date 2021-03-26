<?php include "config.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Vote News</title>
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
    <script>

    </script>


</head>

<body>
 
    <?php include "header.php"; ?>




    <h2 class="text-3xl" style="margin: 10px;">Banded accounts</h2>

    <div class="scrollmenu">
        <?php
        include "config.php";
        $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
        $query = "SELECT * FROM user WHERE role='user' AND is_enabled='0'";
        $queryResult = $db->query($query);
        if (mysqli_num_rows($queryResult) != 0) {

            while ($user = $queryResult->fetch_assoc()) {

                echo '<div class="card cardHover shadow-md"><form method="post" action="activateJournalist.php"";> 
                <div class="card-body">
                    <h4 class="card-title">' . $user["username"] . '</h4>
                    <input value="Activate" id="btnActv" type="submit" class="btn btn-dark">
                    <input type="hidden" name="username" value="' . $user["username"] . '">
                    <input type="hidden" name="operation" value="1">

                </div>
          
            </form></div>';
            }
        } else {


            echo "<h5>No Banded accounts</h5>";
        }



        ?>

    </div>

    <h2 class="text-3xl" style="margin: 10px;">Active accounts</h2>

    <div class="scrollmenu">
        <?php
        include "config.php";
        $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
        $query = "SELECT * FROM user WHERE  role='user' AND is_enabled='1'";
        $queryResult = $db->query($query);
        if (mysqli_num_rows($queryResult) != 0) {

            while ($user = $queryResult->fetch_assoc()) {

                echo '<div class="card cardHover shadow-md"><form method="post" action="activateJournalist.php"";> 
                <div class="card-body">
                    <h4 class="card-title">' . $user["username"] . '</h4>
                    <input value="Band" id="btnActv" type="submit" class="btn btn-dark">
                    <input type="hidden" name="username" value="' . $user["username"] . '">
                    <input type="hidden" name="operation" value="0">

                </div>
          
            </form></div>';
            }
        } else {


            echo "<h5>No Active accounts</h5>";
        }



        ?>

    </div>


 



    <h2 class="text-3xl" style="margin: 10px;margin-top: 20px;">Articals</h2>

    <div class="row row-cols-1 row-cols-md-4">
        <?php
        $query = "SELECT * FROM Article Where state='Process'";
        $result = $db->query($query);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $link = "editorManageArticle.php?articleId=" . $row["article_id"] . "&choice=";
                echo '        <div class="col mb-3">
                     <div class="card cardHover shadow-md" >
                     <img src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['cover_image']) . '" style="height:189px;  width:275px;" class="card-img-top" alt="...">
                     <div class="card-body" style="height:190px;">
                        <h5 class="card-title">' . $row["title"] . '</h5>
                        <hr>
                        <button onclick=" window.location.href = \' articleDetails.php?articleId=' . $row["article_id"] . ';\'" type="button" class="btn btn-outline-primary">Open</button>

                        <button onclick="window.location.href =\'' . $link . 'publish\' " type="button" class="btn btn-outline-success">Publish</button>
                        <button onclick="collectMessage(' . $row["article_id"] . ')" type="button" class="btn btn-outline-warning">Turn back</button>
                    </div>
                </div>         </div>
                ';
            }
        } else {
            echo "<h5 style='margin:20px;'>No articles</h5>";
        }

        ?>


    </div>

</body>

</html>