<?php
//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['username'])){
    header('location: guestbookLogin.php');
}

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin</title>

        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    </head>
    <body>

    </body>
    </html>


<?php


require ('/home2/emaretgr/connect2.php');

$sql = 'SELECT first_name, last_name, company, linkedIn, email, add_to_mailing_list, mail_method, how_we_met, comments, last_visit
    FROM  guestbook';

$result = mysqli_query($cnxn, $sql);


?>

<table id="youth-table" class="display">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Company </th>
        <th>LinkedIn</th>
        <th>Email</th>
        <th>MailList?</th>
        <th>Email Method</th>
        <th>How we met</th>
        <th>Comments</th>
        <th>Visited On</th>

    </tr>
    </thead>
    <tbody>

    <?php
    //Print the results
    while ($row = mysqli_fetch_assoc($result)) {
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $company = $row['company'];
        $linkedIn = $row['linkedIn'];
        $email = $row['email'];
        $mailList = $row['add_to_mailing_list'];
        $mailMethod = $row['mail_method'];
        $meetMethod = $row['how_we_met'];
        $comments = $row['comments'];
        $timeOfVisit = $row['last_visit'];

        echo "<tr>
                <td>$firstName</td>
                <td>$lastName</td>
                <td>$company</td>
                <td>$linkedIn</td>
                <td>$email</td>
                <td>$mailList</td>
                <td>$mailMethod</td>
                <td>$meetMethod</td>
                <td>$comments</td>
                <td>$timeOfVisit</td>

              </tr>";
    }
    ?>


    </tbody>
</table>

<a id = "add" href="guestbook.html">Sign GuestBook</a>

<script src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
    $('#youth-table').DataTable({
        "order": [[ 0, "desc" ]]
    }) ;
</script>

</body>
</html>
