<?php

if (!isset($_SESSION['username'])) {
    header('location: signIn.php');
} else {
    if (isset($_SESSION["role"]) && $_SESSION["role"] != "user") {
        header('location: index.php');
    }
   
}
