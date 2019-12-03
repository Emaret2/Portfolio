<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);



$first = $_POST["firstName"];
$last = $_POST["lastName"];
$company = $_POST["company"];
$linkedIn = $_POST["linkedIn"];
$email = $_POST["email"];
if(!empty($_POST["mailList"])){
    $mailList = $_POST["mailList"];
}
if(!empty($_POST["method"])) {
    $emailMethod = $_POST["method"];
}
$meetMethod = $_POST["meetMethod"];
$meetOther = $_POST["meetOther"];
$comment = $_POST["comment"];

$isValid = true;


/*
 *
 *  Functions
 *
 */

function names()
{
    global $isValid;
    global $first;
    global $last;
    if (!empty($first)) {
        if (!empty($last)) {
            return "$first $last";
        } else {
            $isValid = false;
            return '<p class = \'error\'>last name is required</p>';
        }
    } else {
        $str =  '<p class = \'error\'>first';
        if (empty($last)) {

            $str = $str.' and last names are';
        } else {
            $str = $str.' name is';
        }
        $isValid = false;
        $str = $str.' required</p>';
        echo $str;
    }
}


function company()
{
    global $company;
    if (!empty($company)) {
        return $company;
    } else {
        return 'none';
    }
}

function linkedIn()
{
    global $isValid;
    global $linkedIn;
    if (!empty($linkedIn)) {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $linkedIn)) {
            echo "<p class = 'error'>invalid linkedIn URL</p>";
            $isValid = false;
        } else {
            return $linkedIn;
        }
    } else {
        return 'none';
    }
}

function mailList()
{
    global $mailList;
    if (!empty($mailList)) {
        return $mailList;
    } else {
        return 'no';
    }
}


function email()
{
    global $isValid;
    global $mailList;
    global $email;

    if ($mailList == "yes") {
        if (!empty($email)) {
            if (preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)) {
                return $email;
            } else {
                $isValid = false;
                echo '<p class = \'error\'>invalid email</p>';
            }
        } else {
            $isValid = false;
            echo '<p class = \'error\'>email is required</p>';

        }
    } else {
        if (!empty($email)) {
            if (preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)) {
                return $email;
            } else {
                $isValid = false;
                echo '<p class = \'error\'>invalid email</p>';
            }
        } else {
            return 'none';
        }
    }
}



function meetMethod()
{
    global $isValid;
    global $meetMethod;
    global $meetOther;
    $validMeetMethods = array('none', 'word-of-mouth', 'job-fair', 'unacquainted', 'other');

    if (in_array($meetMethod, $validMeetMethods)) {
        if ($meetMethod == 'none') {
            $isValid = false;
            echo '<p class = \'error\'>How we met is required</p>';
        } else if ($meetMethod == 'other') {
            return " $meetOther";
        } else {
            return " $meetMethod";
        }
    } else {
        $isValid = false;
        echo '<p class = \'error\'>Invalid Method.</p>';
    }
}

function comment()
{
    global $comment;
    if (!empty($comment)) {
        return $comment;
    } else {
        return 'none';
    }
}

/*
 *
 * names()
 * company()
 * linkedIn()
 * mailList()
 * email()
 * meetMethod()
 * comment()
 *
 */

$name = names();
$company = company();
$linkedIn = linkedIn();
$mailList = mailList();
$email = email();
$meetMethod = meetMethod();
$comment = comment();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
    <?php
    if (!$isValid){
        echo 'Sorry';
    } else {
        echo 'Thanks';
    }
    ?>
    </title>
</head>
<body>
    <?php
    if (!$isValid){
        echo '<h1> The above items are invalid';
    } else {

        // Adding to database
        require ('/home2/emaretgr/connect2.php');
        $sql = "insert into guestbook (first_name, last_name, company, linkedIn, email,
            add_to_mailing_list, mail_method, how_we_met, comments) 
        values ('$first', '$last', '$company', '$linkedIn', '$email', '$mailList', '$emailMethod', '$meetMethod', '$comment');";
        // echo $sql; //copy/paste into phpMyAdmin to test
        $result = mysqli_query($cnxn, $sql);


        if($result) {
            echo '<h1>Thank You!</h1>';
            echo '<h2>Summary:</h2>';
            echo "<p>Name: $name</p>";
            echo "<p>Company: $company</p>";
            echo "<p>LinkedIn: $linkedIn</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Add to the mail list: $mailList</p>";
            if (!empty($emailMethod)) {
                echo "<p>Email Method: $emailMethod</p>";
            }
            echo "<p>How we met: $meetMethod</p>";
            echo "<p>Extra comments: $comment</p>";
        }
        else {
            echo "<p> Sorry, but your information was not submitted</p>";
        }
    }




    ?>


    <a id = "add" href="guestbook.html">Return To Guestbook</a>


</body>
</html>