<?php
require_once 'includes/Gradebook.php';
require_once 'includes/Database.php';

$gradebook = new GradeBook();
$gradebook->loadFromDatabase($db);
$students = $gradebook->getAllStudents();
$classAverage = $gradebook->getClassAverage();
$performanceLevels = ['All', 'Excellent', 'Good', 'Average', 'Needs Improvement', 'NA'];


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $performance = $_GET['performance'] ?? false;
    if ($performance == 'All') {
        $performance = false;
    }

    $gradeOrder = $_GET['grade'] ?? '-';
    $nameOrder = $_GET['name'] ?? '-';

    if ($gradeOrder != '-') {
        $students = $gradebook->sortStudentsByGrade($students, $gradeOrder, "average");
    } elseif ($nameOrder != "-") {
        $students = $gradebook->sortStudentsByGrade($students, $nameOrder, "name");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\style.css">
    <title>DashBoard</title>
</head>

<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="add-student.php">Add Student</a>
        <a href="add-grade.php">Add Grade</a>
        <a href="report.php">View Report</a>
    </div>
    <h1>Total Students</h1>
    <p>Total Student: <?php echo count($students); ?></p>
    <p>Class Average: <?php echo isset($classAverage) ? $classAverage : 'N/A'; ?></p>

    <!-- Sorting and filtering for table -->
    <form class="form-table" method="GET">
        <table>
            <tr>
                <th>Name
                    <select class="in-table" name="name" id="name">
                        <option value="-">-</option>
                        <option value="Asc">Ascending</option>
                        <option value="Desc">Descending</option>
                    </select>
                </th>
                <th>Average Grade
                    <select class="in-table" name="grade" id="grade">
                        <option value="-">-</option>
                        <option value="Desc">Descending</option>
                        <option value="Asc">Ascending</option>
                    </select>
                </th>
                <th>
                    Performace
                    <select class="in-table" name="performance" id="performance">
                        <?php foreach ($performanceLevels as $option): ?>
                            <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                        <?php endforeach ?>
                    </select>
                </th>
            </tr>
            <?php
            foreach ($students as $student) {
                if ($performance && $student->toArray()['performance_level'] != $performance) {
                    continue;
                }
                echo "<tr>";
                echo "<td> {$student->toArray()['name']} </td>";
                echo "<td> {$student->toArray()['average']} </td>";
                echo "<td> {$student->toArray()['performance_level']} </td>";
                echo "</tr>";
            }
            ?>
        </table>
        <button>Apply Filter</button>
    </form>

</body>

</html>