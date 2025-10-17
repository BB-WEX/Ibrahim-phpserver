<?php

require_once "helpers.php";

class Student
{
    public $id;
    private string $name;
    private array $grades;

    public function __construct($id, $name, $grades = [])
    {
        $this->id = isset($id) ? $id : generateUniqueId();
        $this->name = $name;
        $this->grades = $grades;
    }

    // Adds a grade to student
    public function addGrade($subject, $score)
    {
        $this->grades[$subject] = $score;
    }


    // Calculates the avarage grade/score of student
    public function calculateAverage()
    {
        if (count($this->grades) > 0) {
            return formatAverage(array_sum($this->grades) / count($this->grades));
        }
    }

    // Gets performance level based on grade/score average
    public function getPerformaceLevel()
    {
        $average = $this->calculateAverage();
        if ($average >= 90) {
            return 'Excellent';
        } elseif ($average >= 80) {
            return 'Good';
        } elseif ($average >= 70) {
            return 'Average';
        } elseif ($average == 0) {
            return "NAN";
        } else {
            return 'Needs Improvement';
        }

    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'grades' => $this->grades,
            'average' => $this->calculateAverage(),
            'performance_level' => $this->getPerformaceLevel()
        ];
    }
}

?>