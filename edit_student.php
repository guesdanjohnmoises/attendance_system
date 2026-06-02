<?php
include 'db.php';

// Check if ID is passed in the URL
if(!isset($_GET['id'])) {
    header("Location: students.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch existing data for the student
$query = "SELECT * FROM students WHERE student_id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// If student doesn't exist, kick back to main list
if(!$row) {
    header("Location: students.php");
    exit();
}

// UPDATE STUDENT
if(isset($_POST['update_student']))
{
    $student_number = mysqli_real_escape_string($conn, $_POST['student_number']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $grade_level = mysqli_real_escape_string($conn, $_POST['grade_level']);
    $section_name = mysqli_real_escape_string($conn, $_POST['section_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE students SET 
            student_number='$student_number', 
            firstname='$firstname', 
            lastname='$lastname', 
            grade_level='$grade_level', 
            section_name='$section_name', 
            gender='$gender', 
            status='$status' 
            WHERE student_id='$id'";

    if(mysqli_query($conn, $sql)) {
        header("Location: students.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="main">

    <h1>Edit Student</h1>

    <div class="card">
        <form method="POST">
            Student Number<br>
            <input type="text" name="student_number" value="<?php echo htmlspecialchars($row['student_number']); ?>" required><br><br>

            First Name<br>
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" required><br><br>

            Last Name<br>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" required><br><br>

            Grade Level<br>
            <input type="text" name="grade_level" value="<?php echo htmlspecialchars($row['grade_level']); ?>" required><br><br>

            Section<br>
            <input type="text" name="section_name" value="<?php echo htmlspecialchars($row['section_name']); ?>" required><br><br>

            Gender<br>
            <select name="gender">
                <option <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>
                <option <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>
            </select><br><br>

            Status<br>
            <select name="status">
                <option <?php if($row['status']=="Active") echo "selected"; ?>>Active</option>
                <option <?php if($row['status']=="Inactive") echo "selected"; ?>>Inactive</option>
            </select><br><br>

            <button type="submit" name="update_student" class="btn-save">
                Update Student
            </button>
            <a href="students.php" style="margin-left: 10px; text-decoration: none; color: gray;">Cancel</a>
        </form>
    </div>

</div>

</body>
</html>