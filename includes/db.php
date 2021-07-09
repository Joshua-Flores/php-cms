<?php 



$DB_HOST = $_ENV['DB_HOST'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASSWORD = $_ENV['DB_PASSWORD'];
$DB_NAME = $_ENV['DB_NAME'];

$connection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);


?>