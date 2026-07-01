<?php

$conn = new mysqli("localhost", "root", "", "studycoach");

if ($conn->connect_error) {
    die("Verbinding mislukt");
}

?>