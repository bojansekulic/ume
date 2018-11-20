<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "netfish";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(isset($_GET['hash'])){
    $sql = "SELECT * FROM `sent_emails` where hash = '".$_GET['hash']."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

        while($row = mysqli_fetch_assoc($result)) {
            $opens = intval($row['opens']);
        }
        $opens++;
        $sql2 = 'update `sent_emails` set opens = '.$opens.' where hash = "'.$_GET['hash'].'"';
        mysqli_query($conn, $sql2);


    }
}
//output the image
header('Content-Type: image/gif');
header( 'Cache-Control: no-cache' );
readfile('dg45s.gif');

// This echo is equivalent to read an image, readfile('pixel.gif')
//echo "\x47\x49\x46\x38\x37\x61\x1\x0\x1\x0\x80\x0\x0\xfc\x6a\x6c\x0\x0\x0\x2c\x0\x0\x0\x0\x1\x0\x1\x0\x0\x2\x2\x44\x1\x0\x3b";






