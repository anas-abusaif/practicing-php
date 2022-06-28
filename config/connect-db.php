<?php 
$conn = mysqli_connect('localhost', 'anas', 'AO12345678', 'practicing-php');
if (!$conn) {
    echo 'connection error' . mysqli_connect_error();
}
?>