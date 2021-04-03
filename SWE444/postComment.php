<?php
include "config.php";

session_start();

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
$comment = mysqli_real_escape_string($db, $_POST['comment']);
$articleId = mysqli_real_escape_string($db, $_POST['articleId']);
$username = $_SESSION["username"];




     //  create new user meta for the notifications this meta contains commenter_username and book id we use it to get url and add notifcation
     // identify the commenter
     // get the book seller username
     $seller_query = "SELECT `Seller_user` FROM `book` AS a WHERE book_id = '$articleId'";
     $result_seller = $db->query($seller_query);

     if ($result_seller->num_rows > 0) {
        $query = "INSERT INTO `comment`(`article_id`, `comment_username`, `comment`) VALUES ('$articleId','$username','$comment')";
        $result = mysqli_query($db, $query);
        $seller_username = $result_seller->fetch_assoc()['Seller_user'];

        // return the post url handle if user !write more than one comment
        $posturl = '';
        // filter url if come write comment after redirect from new comment
        if (strpos($_SERVER['HTTP_REFERER'],"message=") !== false){
           $posturl = explode('&message=',$_SERVER['HTTP_REFERER'])[0];
         } else{
           $posturl = $_SERVER['HTTP_REFERER'];
           //echo "Word Not Found!";
         }

         if (strpos($_SERVER['HTTP_REFERER'],"deactive=") !== false){
           $posturl = explode('&deactive=',$_SERVER['HTTP_REFERER'])[0];
         }

        $article_user_comment = $articleId . '_' . $username . '_' . $db->insert_id . '_' . $posturl;
        $new_meta = "INSERT INTO `user_meta`(`meta_key`, `meta_value`, `username`, `active`) VALUES ('comment_data', '$article_user_comment' , '$seller_username', 1)";
        $result2 = mysqli_query($db, $new_meta);
   };
   // create new meta for the new comment include articleid and book_seller


       mysqli_close($db);

     if ($result && $result2) {

         header("location:articleDetails.php?articleId=" . $_POST['articleId'] . "&message=Thank you for your comment");
     } else {
      header("location:articleDetails.php?articleId=" . $_POST['articleId'] . "&message=" . $articleId .$username .$comment );
       // header("location:articleDetails.php?articleId=" . $_POST['articleId'] . "&message=An error occur while posting your comment");

   }
