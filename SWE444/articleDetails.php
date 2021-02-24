<?php
session_start();
include "config.php";
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
$query = "SELECT * FROM Article Where article_id='" . $_REQUEST["articleId"] . "'";
$result = $db->query($query);
$article;
if ($result) {

    $article = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Vote News</title>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>

    <script>
        function checkComment() {
            if ($("#comment").val() == "") {
                // $("#comment-error").css("display", "block");
                return false;
            }
            return true;
        }
    </script>

</head>

<body>
    <?php include "header.php"; ?>


    <section id="articalSec" class="prevSec shadow-sm">
        <h1 class="text-4xl" style="margin-bottom: 15px;"><?php echo $article["title"]; ?></h1>
        <p style="color: rgb(91,91,91);">Written by <?php echo $article["writer_username"]; ?></p>
        <img <?php echo 'src="data:image/jpg;charset=utf8;base64,' . base64_encode($article['cover_image']) . '"'; ?> style="max-height:400px;" ; class="card-img-top" alt="...">
        <div class="articalText">

            <p>

                <?php echo $article["body"]; ?>
            </p>


        </div>

        <script>
            document.querySelectorAll('oembed[url]').forEach(element => {
                // Create the <a href="..." class="embedly-card"></a> element that Embedly uses
                // to discover the media.
                const anchor = document.createElement('a');

                anchor.setAttribute('href', element.getAttribute('url'));
                anchor.className = 'embedly-card';

                element.appendChild(anchor);
            });
        </script>
    </section>


    <section id="commintSection" class="prevSec shadow-sm" style="margin-top: 20px;">

        <h1 class="text-4xl" style="margin: 5px;">Comments</h1>

        <?php
        $query = "SELECT * FROM Comment Where article_id='" . $_REQUEST["articleId"] . "'";
        // $result = mysqli_query($db, $query);
        $result = $db->query($query);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card shadow-sm" id="comment1" style="padding-left: 10px; margin-bottom:10px;">        
                    <p id="comment-userName"><strong>' . $row["comment_username"] . '</strong></p>
                    <p id="comment-Text">' . $row["comment"] . '</p> </div>       
                    ';
            }
        } else {
            echo '<div class="card shadow-sm" id="comment1" style="padding-left: 10px; margin-bottom:10px;"><h5>No comments posted yet !</h5></div>';
        }

        ?>



        <?php if (isset($_SESSION['username'])) : ?>


            <div id="writeComment">
                <form method="post" action="postComment.php">
                    <div class="form-group" id="comment">
                        <p><strong>Write your comment here:</strong></p><textarea id="comment" style="resize: none;margin-top: 0px;width: 100%;height: 85px;border-color: rgba(0,0,0,0);border-radius: 4px;" placeholder="Comment" maxlength="300" minlength="5" name="comment" required></textarea>
                        <div id="comment-error" style="display:none;" class="alert alert-warning" role="alert">Please write your comment</div>
                        <button class="btn btn-dark" type="submit" style="margin-top: 11px;" name="submit">Comment</button>
                    </div>
                    <input type="hidden" id="custId" name="articleId" value="<?php echo $_REQUEST["articleId"]; ?>">

                </form>
            </div>

        <?php else : ?>
            <div class=" alert alert-dark" role="alert" style="margin-top: 15px;">
                Please sign in if you want to comment
            </div>
        <?php endif ?>
        <?php if (isset($_REQUEST['message'])) : ?>
            <div class="alert alert-dark" role="alert">
                <?php echo $_REQUEST['message']; ?>
            </div>
        <?php endif ?>



    </section>


</body>

</html>