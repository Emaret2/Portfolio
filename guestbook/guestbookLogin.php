<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

$invalid = false;

//If the user is already logged in
if (isset($_SESSION['username'])){
    header('location: admin.php');
}

//Redirect to admin page





//If the login form has been submitted
if (isset($_POST['submit'])) {
    include ('guestbookCreds.php');


    //Put in home directory later)


    //Get the username and password from the POST array
    $username = $_POST['username'];
    $password = $_POST['password'];

    //If the username and password are correct
    if (array_key_exists($username, $login) && $login["$username"] == $password){
        $_SESSION['username'] = $username;



        //Store login name in a session variable


        header('location: admin.php');

        //Redirect to the admin page


    } else {
        //Login credentials are incorrect
        $invalid = true;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>

    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../ArchCSS/index.css">
</head>
<body>
<body>
<header id="header">
    <div class="jumbotron text-center">
        <h1 class="display-4">
            <?php
            if($invalid){
                echo 'Invalid Login';
            }
            else {
                echo 'Login';
            }
            ?>
        </h1>

    </div>

</header>

<form method="post" action="#">
    <fieldset class = 'form-group form-check'>
        <div >
            <label>Username:
                <input class = 'form-control' type="text" name="username">
            </label><br>
        </div>

        <div >
            <label>Password:
                <input class = 'form-control' type="password" name="password">
            </label><br>
        </div>
        <input id="login" type="submit" name="submit" value="Submit">
    </fieldset>
</form>
</body>
</html>

