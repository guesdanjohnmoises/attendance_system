<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "school_attendance"
);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>