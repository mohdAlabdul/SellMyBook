<?php include "config.php";
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

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
    <script src="jquery-3.5.1.min.js"></script>

    <script>
        function validatePassword() {
            let password = $("#password").val();
            let confirmPassword = $("#confirm-password").val();
            if (password != confirmPassword) {
                $("#error-message").show();
                return false;
            }
            return true;

        }
    </script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
            <a href="index.php"> <img class="navicon" src="assets/img/webIcon.jpg"></a>
            <a class="navbar-brand titleFont" href="index.php" style="margin: auto;">Vote News&nbsp;</a>
    </nav>

    <div class="register-photo flex justify-center ">

        <form action="resetPass.php" method="post" class="shadow-md" onsubmit="return validatePassword()">
            <h2 class="text-center "><strong>It's your first time, </strong> change your password</h2>



            <div class="form-group"><input id="password" class="form-control" type="password" name="password" placeholder="Password" required="">
            </div>
            <div class="form-group"><input class="form-control" id="confirm-password" type="password" name="confirm-password" placeholder="Confirm password" required="">
            </div>
            <div id="error-message" class="alert alert-danger" role="alert" style="display: none;">
                Please make sure your password match
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="change_pass">change
                    password</button>

        </form>
    </div>
    </div>

</body>

</html>
<?php
//when submit get clicked
if (isset($_POST["change_pass"])) {
    $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");
    $password = $_POST["password"];
    $username = $_SESSION["username"];
    // change password
    $query = "UPDATE User SET password='$password' WHERE username='$username' ";
    mysqli_query($db, $query);
    // update flag
    $query = "UPDATE User SET is_first_time='0' WHERE username='$username' ";
    mysqli_query($db, $query);



    header("location: index.php");
}
?>