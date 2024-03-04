<?php
$hostname="localhost:3302";
$dbuser="root";
$dbpass="";
$dbname="port2";



$conn=mysqli_connect($hostname,$dbuser,$dbpass,$dbname);
if(!$conn)
{
    die("Something went wrong");
}
?>