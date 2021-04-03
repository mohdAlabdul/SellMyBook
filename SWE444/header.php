<?php


?>
<!DOCTYPE html>
<html lang=en>

<?php
include "config.php";
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");


function notifactions_count($loged_username, $db) {
$active_notifcations = "SELECT COUNT(meta_id) AS actives FROM `user_meta` WHERE active = 1 AND username = '$loged_username'";
$active_notifcations_list =  $db->query($active_notifcations);
$notifaction_count = '';
if ($active_notifcations_list->num_rows > 0){
  $notifaction_count = $active_notifcations_list->fetch_assoc();

  // if count 0
  if ($notifaction_count['actives'] == 0) {
     return array('count' => '', 'class' => '');
  } else {
  $result = array('count' => $notifaction_count['actives'], 'class' => 'badge');
  return $result;
  }
} else {
  $result = array('count' => '', 'class' => '');
  return $result;
}
}

function create_notifcations($db){

  if (isset($_SESSION['username'])) {

    $loged_user = $_SESSION['username'];
    // create notifcation sql
    /*
       Trible JOIN Query to create notifcation in one line depend on the user_meta.username  and logeduser.username  and comment.comment_username
    */


    function get_comment_byid($comment_id, $db){
      $query0 = "SELECT * FROM `comment` WHERE comment.comment_id = '$comment_id'";
      $commentObj = $db->query($query0);
      if ($commentObj->num_rows > 0) {
        return $commentObj->fetch_assoc();
      } else {
        return '';
      }
    }

    $thequery = "SELECT * FROM `user_meta` WHERE user_meta.username = '$loged_user' ORDER BY meta_id";
    $notifcations_query = "SELECT user.username, comment.comment, comment.comment_id, user_meta.meta_value, user_meta.meta_id, comment.article_id, user_meta.active FROM `user` INNER JOIN `comment` ON user.username = comment.comment_username INNER JOIN user_meta ON user_meta.username = user.username WHERE user.username = '$loged_user' ORDER BY user_meta.meta_id ASC";

    $notifcations_meta_list = $db->query($thequery);
    //$db->query($notifcations_query);
    if ($notifcations_meta_list) {


       $some_text = '';
       function  active_comment_class($active_value) {
             $active_class = 'active_comment';
             if ($active_value == 1) {
                return 'class="active_comment"><i class="fa fa-circle" style="color:#3578E5"></i>';

             } else {
                return '';
             }
       }

       while ($row = $notifcations_meta_list->fetch_assoc()) {
            //  $link_url = get_article_url($row['article_id']);


              $metdadata = explode('_' , $row['meta_value']);


              if (count($metdadata) > 3) {
              $deactive_paramter = $row['active'] == 1 ? '&deactive=' . $row['meta_id'] : '';
              $activeclass = active_comment_class($row['active']);


              $comment_message = 'You recived comment from: ' . $metdadata[1];
              if ($activeclass != '') {
              $some_text .= '<a href="' . $metdadata[3] . $deactive_paramter . '" ' .  $activeclass . ' <span >' . $comment_message . '<b>';
              $some_text .= '</b> </span><br /><br /><span class="mini_comment">';
              $some_text .= get_comment_byid($metdadata[2], $db)['comment'];
              $some_text .= '</span></a>';
            }


            }

       }
       return $some_text;
    } else {
       return 'query_error';
    }
  }
}
<<<<<<< HEAD
/*
$get_notifcations = "SELECT * FROM `user_meta` WHERE meta_key='comment_data' AND username='$loged_user'";
$notifcations_meta = $db->query($get_notifcations);
if ($notifcations_meta->num_rows > 0) {
    $zopry = '';
    // create the comment front end array include url, commenter_name , comment slice
    while ($row = $notifcations_meta->fetch_assoc()) {
      // code...

    $comment_meta = explode("_", $row['meta_value']);
    $comments_length = count($comment_meta);
    $post_id = $comment_meta[0];
    $commenter_author = $comment_meta[1];
    $comment_id = 53;

    $comment_url = get_article_url($post_id);

    // get comment content  SELECT * FROM `comment` ORDER BY `article_id` ASC
    $comment_query = "SELECT comment FROM `comment` WHERE comment_id='$comment_id'";
    $comment_content = $db->query($comment_query);
    $tcomment = $comment_content->fetch_assoc();


    print_r($comment_content);
    }
}
    return $zopry;
} else {
    return '';
};

}
*/
=======
>>>>>>> parent of 307bb38 (dcd)
?>

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
    <script src="assets/js/notification.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">

            <a class="navbar-brand titleFont" href="index.php">SellMyBook</a>

            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1" style="color: rgb(255,255,255);background: #ffffff;">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon" style="width: 20px;height: 24px;"></span>
            </button>

            <div class="collapse navbar-collapse text-right" id="navcol-1">
                <input class="ml-auto " type="search" id="searchBar" placeholder=" Search" style=" visibility: hidden; border-style: none;padding: 5px;border-radius: 10px;background: rgb(0,0,0);color: rgb(255,255,255);margin-right: 10px;">
                <span class="navbar-text actions">

                    <?php if (isset($_SESSION['username'])) : ?>
                        <span class="login" style="color: #ffffff;background: #000000;">Welcome, <?php echo $_SESSION['username']; ?></span>
                        <?php if ($_SESSION["role"] == "user"){
                        echo '<a class="btn btn-light action-button transform hover:scale-110 motion-reduce:transform-none " role="button" href="directToDashboard.php" style="margin-right: 10px;">Dashboard</a>';  }?>


                        <?php if ($_SESSION["role"] == "admin"){
                        echo '<a class="btn btn-light action-button transform hover:scale-110 motion-reduce:transform-none " role="button" href="editorDashboard.php" style="margin-right: 10px;">Dashboard</a>';  }?>






                        <a class="btn btn-light action-button transform hover:scale-110 motion-reduce:transform-none" role="button" href="logout.php">Log out</a>

                        <!-- notifications_button -->


                        <span class="dropdown not_icon">
                          <button onclick="myFunction()" class="dropbtn btn btn-light" stlye="width:50px;">
                            <i class="fa fa-bell" style="font-size:"></i>
                               <span class="<?php if (isset($_SESSION['username'])) { echo notifactions_count($_SESSION['username'], $db)['class'];} ?>">
                                <?php if (isset($_SESSION['username'])) { echo notifactions_count($_SESSION['username'], $db)['count'];} ?>
                              </span>
                          </button>
                          <div id="myDropdown" class="my-dropdown-content" style="width:300px !important;text-align:left;">
                            <!-- notifcation sample do not remove
                            <a class="active_comment"><i class="fa fa-circle" style="color:#3578E5"></i> <span >You recived comment from: <b>Adele</b> </span><br /><br /><span class="mini_comment">Heaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaallo</span></a>
                             -->
                            <?php echo create_notifcations($db); ?>
                          </div>
                        </span>
                    <?php else : ?>
                        <!-- logged in user information -->

                        <a class="login" href="signIn.php" style="color: #ffffff;background: #000000;">Log In</a>
                        <a class="btn btn-light action-button transform hover:scale-110 motion-reduce:transform-none" role="button" href="signUp.php">Sign Up</a>
                    <?php endif ?>
                </span>


            </div>
        </div>
    </nav>
</body>

</html>
