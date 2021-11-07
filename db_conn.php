<?php
$username = "root";
$servername = "localhost";
$password = "3183";
$conn = new mysqli($servername, $username, $password, "coinage_crew");
if ($conn->connect_error)
    die("Connection Error");

// echo "<script>console.log('Connected to DB');</script>";
?>