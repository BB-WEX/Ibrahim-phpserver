<?php
require_once 'includes/Gradebook.php';
require_once 'includes/helpers.php';

$gradebook = new Gradebook();
$students = $gradebook->getAllStudents();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $subject = ucfirst(trim($_POST['subject']));
    $grade = $_POST['grade'];

    if (validateScore($grade) && !empty($subject)) {
        $student = $gradebook->findStudentById($id);
        if ($student) {
            $student->addGrade($subject, $grade);
            $gradebook->saveToFile("data/student.txt");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\style.css">
    <title>Add Grade</title>
</head>

<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="add-student.php">Add Student</a>
        <a href="add-grade.php">Add Grade</a>
        <a href="report.php">View Report</a>
    </div>
</body>
<h1>Add or Replace Grade</h1>
<form method="POST">
    <label for="id">Select Student</label>
    <select name="id">
        <?php foreach ($students as $student): ?>
            <option value="<?php echo $student->toArray()["id"]; ?>"><?php echo $student->toArray()["name"]; ?></option>
        <?php endforeach ?>
    </select>
    <br>

    <label for="subject">Subject</label>
    <input type="text" name="subject" required>
    <br>

    <label for="grade">Score/Grade</label>
    <input type="number" name="grade" required max="100" min="1">
    <button>Add/Replace Grade</button>
</form>

</html>