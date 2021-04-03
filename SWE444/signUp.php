<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>VBooks</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/dh-card-image-left-dark.css">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
           

            <a class="navbar-brand titleFont" style="margin: auto;" href="index.php">SellMyBook</a>
        </div>

    </nav>


    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form action="server.php" method="post" onsubmit="return validatePassword()">
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
                <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="username" placeholder="Username" required="">
                </div>
                <div class="form-group"><input id="password" class="form-control" type="password" placeholder="Password" required name="password"></div>
                <div class="form-group"><input id="confirm-password" class="form-control" type="password" name="password-repeat" placeholder="Confirm Password" required=""></div>

          

                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" required="">I agree to the license terms.</label>
                    </div>
                </div>
                <div id="error-message" class="alert alert-danger" role="alert" style="display: none;">
                    Please make sure your password match
                </div>
                <?php if (isset($_REQUEST["error"])) {
                    echo ' <div id="server-error" class="alert alert-danger" role="alert">' . $_REQUEST["error"] . '
                   </div>';
                } ?>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="reg_user">Sign
                        Up</button>

                </div><a class="already" href="signIn.php">You already have an account? <strong> Login here.</strong></a>

            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
</body>

</html>