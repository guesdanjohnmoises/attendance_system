<?php
$conn = mysqli_connect("localhost", "root", "", "school_attendance");

$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

echo "<h1>Student List</h1>";

while($row = mysqli_fetch_assoc($result)) {
    echo $row['firstname'] . " " . $row['lastname'] . " - " . $row['gender'] . "<br>";
}
?>