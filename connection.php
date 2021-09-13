<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "rezervacija_terminov";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");
}
