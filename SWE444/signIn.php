<!DOCTYPE html>
<html lang="en">
    <!-- hla --> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>VBooks</title>
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

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
           
            <a class="navbar-brand titleFont" href="index.php" style="margin: auto;">SellMyBook</a>
    </nav>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder" style="background-size: cover;background-repeat: no-repeat;"></div>

            <form method="post" action="server.php">
                <?php if (isset($_REQUEST["resgister"])) {
                    echo '<div class="alert alert-success" style="font-size:15px" role="alert">
                ' . $_REQUEST["resgister"] . '
              </div>';
                } ?>
                <h2 class="text-center"><strong>Sign in </strong>to your account.</h2>

                <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username" name="signin-username" required="">
                </div>

                <div class="form-group"><input class="form-control" type="password" name="signin-password" placeholder="Password" required=""></div>
                <?php if (isset($_REQUEST["error"])) {
                    echo ' <div id="server-error" class="alert alert-danger" role="alert">' . $_REQUEST["error"] . '
                   </div>';
                } ?>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="login_user">Sign
                        in</button>
                </div><a class="already" href="signUp.php">You don't have an account? <strong>Sign up
                        here.</strong></a>
            </form>
        </div>
    </div>

</body>

</html>