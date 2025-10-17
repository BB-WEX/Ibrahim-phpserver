<?php
require_once 'includes/Gradebook.php';
require_once 'includes/Student.php';

session_start();
if (!isset($_SESSION['subjectCount'])) {
    $_SESSION['subjectCount'] = 1;
}

if (isset($_POST['addSubject'])) {
    $_SESSION['subjectCount']++;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reset'])) {
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']); // Refrashes the page for new session
        exit;
    }
    if (!isset($_SESSION['name'])) {
        $_SESSION['name'] = ucfirst($_POST['name']);
    }


    if (isset($_POST['submit'])) {
        $name = $_SESSION['name'];
        $subjects = $_POST['subject'] ?? [];
        $grades = $_POST['grade'] ?? [];

        $gradebook = new Gradebook();


        // If subjects have been entered add subjects to student
        $studentGrades = [];
        foreach ($subjects as $i => $subject) {
            if (!empty($subject)) {
                $studentGrades[ucfirst($subject)] = $grades[$i] ?? 0;
            }
        }


        $student = new Student(null, $name, $studentGrades);
        $gradebook->addStudent($student);
        $gradebook->saveToFile('data\student.txt');

        // Reset
        $_SESSION["subjectCount"] = 1;
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']); // Refrashes the page for new session
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\style.css">
    <title>Add Student</title>
</head>

<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="add-student.php">Add Student</a>
        <a href="add-grade.php">Add Grade</a>
        <a href="report.php">View Report</a>
    </div>
</body>
<h1>
    Add a Student
</h1>

<form method="POST">
    <label for="name">Student Name:</label>
    <input type="text" name="name" value="<?php echo $_SESSION["name"] ?? null; ?>" required>
    <br>

    <?php for ($i = 0; $i < $_SESSION['subjectCount']; $i++): ?>
        <label>Subject</label>
        <input type="text" name="subject[]">
        <br>
        <label>Grade</label>
        <input type="number" name="grade[]" min="0" max="100">
        <br>
    <?php endfor; ?>

    <div class="btn-container">
        <button type="submit" name="addSubject">Add Subject</button>
        <button type="submit" name="submit">Submit</button>
    </div>

</form>
<form class="reset" method="POST">
    <button name="reset" id="reset">Reset</button>
</form>


</html>