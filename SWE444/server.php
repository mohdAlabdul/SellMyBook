<?php
include "config.php";
session_start();



$errors = array();



$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("not connected to db");


//reg
if (isset($_POST['reg_user'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password =  mysqli_real_escape_string($db, $_POST['password']);
    $passwordrepeat =  mysqli_real_escape_string($db, $_POST['password-repeat']);



    // val
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if ($password != $passwordrepeat) {
        array_push($errors, "The two passwords do not match");
    }

    // checkuser

    $user_check_query = "SELECT * FROM User WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
    }
    if (count($errors) == 0) {
        $role = mysqli_real_escape_string($db, $_POST['role']);
        echo '<script>alert($role)</script>';
        $isEnabled = "1";
        
       
        $query =

            "INSERT INTO User(username,  password, role, is_enabled) 
    VALUES('$username', '$password','user','$isEnabled')";

        // add to db


        mysqli_query($db, $query);

        header('location: signIn.php?resgister=You have been registered successfully, now please sign in');
    } else {
        header('location: signUp.php?error=' . $errors[0]);
    }
}
if (isset($_POST['login_user'])) {

    $signinUsername = mysqli_real_escape_string($db, $_POST['signin-username']);
    $signinPassword = mysqli_real_escape_string($db, $_POST['signin-password']);

    if (empty($signinUsername)) {
        array_push($errors, "Username is required");
    }
    if (empty($signinPassword)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $query = "SELECT * FROM User WHERE username='$signinUsername' AND password='$signinPassword'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $userRole = "user";
            while ($user = $results->fetch_assoc()) {
                if($userRole == "admin"){
                    $_SESSION['username'] = $signinUsername;

                  $_SESSION["role"] = $userRole;
                     $_SESSION['success'] = "1";
                     header('location: index.php');   // admin page
                }
                $userRole = $user["role"];
                if ($user["is_enabled"] == "0") {
                    session_write_close();
                    if ($userRole == "user" && $user["is_enabled"] == "0")
                        header('location: signIn.php?error=Your account is disabled');
                  
                    exit();
                }
               
            }




            $_SESSION['username'] = $signinUsername;

            $_SESSION["role"] = $userRole;
            $_SESSION['success'] = "1";
            header('location: index.php');  // seller page
        } else {
            header('location: signIn.php?error=Wrong username/password');
        }
    }
}
