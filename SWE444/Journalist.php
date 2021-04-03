<?php include "config.php";
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>SellMyBook</title>
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
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">


</head>



<body>
  <?php include "header.php"; ?>
  <!-- <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
    <div class="container">
      <a href="index.php" class="navicon"><img src="assets/img/webIcon.jpg"></a>
      <a class="navbar-brand titleFont" href="index.php">Vote News&nbsp;</a>
      <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"
        style="color: rgb(255,255,255);background: #ffffff;">
        <span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"
          style="width: 20px;height: 24px;"></span>
      </button>
      <div class="collapse navbar-collapse text-right" id="navcol-1">
        <ul class="nav navbar-nav mr-auto"></ul>
        <span class="navbar-text actions">
          <a class="login" href="signIn.php" style="color: #ffffff;background: #000000;">Log out</a>
          <a class="btn btn-light action-button" role="button" href="writing.html">Write</a>
        </span>
      </div>
    </div>
  </nav> -->
  <?php if ($_SESSION["role"] == "user") : ?>
    <h2 style="margin: 10px;margin-top: 20px;">Articals<input class="form-control-sm ctrl-srch shadow-inner " type="search" placeholder="search" style="border-color: rgb(255,255,255);"></h2>


    <div class="row row-cols-1 row-cols-md-4">
      <div class="col mb-3">
        <div class="card junstyle cardHover shadow-md ">


          <img src="assets/img/product-aeon-feature.jpg" class="card-img-top">
          <div class="card-body ">

            <h5 class="card-title">Artical</h5>
            <button type="button" class="btn btn-outline-success">publish</button>
            <button type="button" class="btn btn-outline-primary">open</button>
            <button type="button" class="btn btn-outline-danger">delet</button>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class=" alert alert-dark" role="alert" style="margin-top: 15px;">
      Please sign in if you want to check Articles
    </div>
  <?php endif ?>
</body>

</html>