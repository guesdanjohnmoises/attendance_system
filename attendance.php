<?php
$conn = mysqli_connect("localhost", "root", "", "school_attendance");

$query = "
SELECT 
students.firstname,
students.lastname,
attendance.status
FROM attendance
INNER JOIN students
ON attendance.student_id = students.student_id
";

$result = mysqli_query($conn, $query);

echo "<h1>Attendance Records</h1>";

while($row = mysqli_fetch_assoc($result)) {
    echo $row['firstname'] . " " . $row['lastname'] . " - " . $row['status'] . "<br>";
}
?>