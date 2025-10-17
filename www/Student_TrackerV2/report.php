<?php

require_once "includes/Gradebook.php";
require_once "includes/helpers.php";

$gradebook = new GradeBook();
$students = $gradebook->getAllStudents();
$topPerformer = $gradebook->getTopPerformer();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\style.css">
    <title>Report</title>
</head>

<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="add-student.php">Add Student</a>
        <a href="add-grade.php">Add Grade</a>
        <a href="report.php">View Report</a>
    </div>

    <h1>Report</h1>
    <h2>Top Perfermer (highest average through all subjects)</h2>
    <div class="top-performer">
        <?php
        echo "<h3>Student: {$topPerformer->toArray()['name']} </h3>";
        echo "<p>Performance: {$topPerformer->toArray()['performance_level']}, {$topPerformer->toArray()['average']}</p>";
        ?>
    </div>

    <h2>Subject Averages</h2>
    <table>
        <tr>
            <th>Subject</th>
            <th>Average Grade</th>
        </tr>
        <?php
        $subjects = [];
        foreach ($students as $student) {
            foreach ($student->toArray()['grades'] as $subject => $grade) {
                $subjects[$subject] = $subject;
            }
        }
        foreach ($subjects as $subject) {
            echo "<tr>";
            echo "<td> {$subject} </td>";
            echo "<td> {$gradebook->getAverageForSubject($subject)} </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Performance Breakdown:</h2>

    <table>
        <tr>
            <th>Performance Level</th>
            <th>Number of Student(s)</th>
        </tr>
        <?php
        $performanceCount = ['Excellent' => 0, 'Good' => 0, 'Average' => 0, 'Needs Improvement' => 0];
        foreach ($students as $student) {
            $performanceCount[$student->getPerformaceLevel()]++;
        }
        foreach ($performanceCount as $performance => $count) {
            echo "<tr>";
            echo "<td>{$performance}</td>";
            echo "<td>{$count}</td>";
            echo "</tr>";
        }
        ?>

    </table>
</body>

</html>