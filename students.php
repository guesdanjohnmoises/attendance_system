<?php
include 'db.php';

// SAVE/INSERT STUDENT
if(isset($_POST['save_student']))
{
    $student_number = mysqli_real_escape_string($conn, $_POST['student_number']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $grade_level = mysqli_real_escape_string($conn, $_POST['grade_level']);
    $section_name = mysqli_real_escape_string($conn, $_POST['section_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO students 
            (student_number, firstname, lastname, grade_level, section_name, gender, status)
            VALUES 
            ('$student_number','$firstname','$lastname','$grade_level','$section_name','$gender','$status')";

    if(mysqli_query($conn, $sql)) {
        // Redirect to prevent form resubmission on page refresh
        header("Location: students.php");
        exit();
    }
}

// DELETE STUDENT
if(isset($_GET['delete']))
{
    $id = mysqli_real_escape_string($conn, $_GET['delete']);

    if(mysqli_query($conn, "DELETE FROM students WHERE student_id='$id'")) {
        // Redirect to clean up the URL after deleting
        header("Location: students.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="sidebar">
    <h2>Mil-an NHS</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="students.php">Student Management</a>
    <a href="attendance.php">Attendance Monitoring</a>
    <a href="schedules.php">Faculty Schedule</a>
    <a href="reports.php">Reports & Analytics</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">

    <h1>Student Management</h1>

    <div class="card">
        <h3>Add Student</h3>
        <form method="POST">
            Student Number<br>
            <input type="text" name="student_number" required><br><br>

            First Name<br>
            <input type="text" name="firstname" required><br><br>

            Last Name<br>
            <input type="text" name="lastname" required><br><br>

            Grade Level<br>
            <input type="text" name="grade_level" required><br><br>

            Section<br>
            <input type="text" name="section_name" required><br><br>

            Gender<br>
            <select name="gender">
                <option>Male</option>
                <option>Female</option>
            </select><br><br>

            Status<br>
            <select name="status">
                <option>Active</option>
                <option>Inactive</option>
            </select><br><br>

            <button type="submit" name="save_student" class="btn-save">
                Save Student
            </button>
        </form>
    </div>

    <div class="card">
        <h3>Student List</h3>
        <table class="student-table">
            <tr>
                <th>No.</th>
                <th>Student No.</th>
                <th>Name</th>
                <th>Grade</th>
                <th>Section</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            $query = "SELECT * FROM students ORDER BY lastname ASC";
            $result = mysqli_query($conn, $query);
            $number = 1;

            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                echo "<td>".$number."</td>";
                echo "<td>".$row['student_number']."</td>";
                echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
                echo "<td>".$row['grade_level']."</td>";
                echo "<td>".$row['section_name']."</td>";
                echo "<td>".$row['gender']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "<td>
                        <a href='edit_student.php?id=".$row['student_id']."' class='btn-edit'>Edit</a>
                        <a href='students.php?delete=".$row['student_id']."' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a>
                      </td>";
                echo "</tr>";
                $number++;
            }
            ?>
        </table>
    </div>

</div>

</body>
</html>