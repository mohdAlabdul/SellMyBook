<!DOCTYPE html>
<html lang=en>

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