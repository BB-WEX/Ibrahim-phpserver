<?php
require_once 'Student.php';
class GradeBook
{

    private array $students = [];

    public function __construct()
    {
        // "/" for mac and linux "\" for windows
        $this->loadfromfile('data/student.txt');
    }

    public function addStudent($student)
    {
        array_push($this->students, $student);
    }

    public function findStudentById($id)
    {
        foreach ($this->students as $student) {
            if ($student->id === $id) {
                return $student;
            }
        }
        return null;
    }

    public function getAllStudents()
    {
        return $this->students;
    }

    // Gets the student with the highest average score through all subjects
    public function getTopPerformer(): mixed
    {
        $topStudent = null;
        $highestAverage = 0;
        foreach ($this->students as $student) {
            $average = $student->calculateAverage();
            if ($average > $highestAverage) {
                $highestAverage = $average;
                $topStudent = $student;
            }
        }
        return $topStudent;

    }

    // Calculates the average score for a specific subject across all students and returns it as a whole number
    public function getAverageForSubject($subject)
    {
        $subjectAverage = 0;
        $count = 1;
        foreach ($this->students as $student) {
            $grades = $student->toArray()['grades'];
            if (isset($grades[$subject])) {
                $subjectAverage += $grades[$subject];
                $count++;
            }
        }
        return formatAverage($subjectAverage / $count);
    }

    public function getClassAverage()
    {
        $average = 0;
        foreach ($this->students as $student) {
            $average += $student->toArray()['average'];
        }
        if ($average > 0) {
            return formatAverage($average / count($this->students));
        }
    }

    // Sorts based on name or average score 
    // If one was chosen the other would be sorted after
    public function sortStudentsByGrade(array $students, string $sortBy, string $sortItem): array
    {
        $arrayName = array_map(function ($student) {
            return $student->toArray()['name'];
        }, $students);
        $arrayGrade = array_map(function ($student) {
            return $student->toArray()['average'];
        }, $students);

        if ($sortBy == 'Asc') {
            $sortItem == "name" ?
                array_multisort($arrayName, SORT_ASC, $arrayGrade, SORT_DESC, $students) :
                array_multisort($arrayGrade, SORT_ASC, $arrayName, SORT_ASC, $students);
        } else {
            $sortItem == "name" ?
                array_multisort($arrayName, SORT_DESC, $arrayGrade, SORT_DESC, $students) :
                array_multisort($arrayGrade, SORT_DESC, $arrayName, SORT_ASC, $students);
        }

        return $students;
    }

    // Saves students data to a file (students.txt)
    public function saveToFile($filename)
    {
        $data = array_map(function ($student) {
            return $student->toArray();
        }, $this->students);
        file_put_contents($filename, json_encode($data));

    }

    // Loads students data from a file (students.txt)
    public function loadFromFile($filename)
    {
        $data = array_map(function ($student) {
            return new Student($student['id'], $student['name'], $student['grades']);
        }, json_decode(file_get_contents($filename, true), true));
        $this->students = $data;
    }
}
?>