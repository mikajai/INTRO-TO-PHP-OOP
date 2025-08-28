<?php

class Student {

    // private data fields
    private $name;
    private $courses = [];

    // constructor
    public function __construct($name) {
        $this->name = $name;
    }

    // method for adding a course under a student name
    public function addCourse(Course $course) {
        $this->courses[] = $course;
    }

    // method for removinf a course under a student name
    public function removeCourse(Course $course) {
        $key = array_search($course, $this->courses, true);
        if ($key !== false) {
            unset($this->courses[$key]);
            $this->courses = array_values($this->courses);
            return $course->getCourseName();
        }
        return null;
    }

    // method for getting the total enrollment fee of the student
    public function getTotalEnrollmentFee() {
        $totalFee = 0;
        foreach ($this->courses as $course) {
            $totalFee += $course->getCourseCost();
        }
        return $totalFee;
    }

    // method for displaying the enrollment details of the student
    public function enrollmentDetails() {
        echo "Student Name: " . $this->name . "<br>";
        echo "<br>" . "Enrolled Courses: ";
        echo "<ul>";
            foreach ($this->courses as $course) {
                echo "<li>" . $course->getCourseName() . "</li>";
            }
        echo "</ul>";

        echo "Total Enrollment Fee: " . $this->getTotalEnrollmentFee();

    }
    
}

class Course {

    // private data fields
    private $name;
    private $cost = 1450;

    // constructor
    public function __construct($name) {
        $this->name = $name;
    }

    // method for getting the course name
    public function getCourseName() {
        return $this->name;
    }

    // method for getting the cost of the course
    public function getCourseCost() {
        return $this->cost;
    }
    

}

// showing all the added courses; without removing any course
$student = new Student("Mikka Jairrah Martinez");

$profElec = new Course("Professional Elective 2");
$softEng = new Course("Software Engineering 2");
$analysis = new Course("Data Analysis for Computer Science");
$thesis = new Course("CS Thesis Writing");
$practicum = new Course("Practicum 240hrs");

$student->addCourse($profElec);
$student->addCourse($softEng);
$student->addCourse($analysis);
$student->addCourse($thesis);
$student->addCourse($practicum);

$student->enrollmentDetails();

echo "<br><br>" . "===========================================================" . "<br><br>";


// showing how the removeCourse() method works
$student = new Student("Mikka Jairrah Martinez");

$profElec = new Course("Professional Elective 2");
$softEng = new Course("Software Engineering 2");
$analysis = new Course("Data Analysis for Computer Science");
$thesis = new Course("CS Thesis Writing");
$practicum = new Course("Practicum 240hrs");

$student->addCourse($profElec);
$student->addCourse($softEng);
$student->addCourse($analysis);
$student->addCourse($thesis);
$student->addCourse($practicum);

echo "Removed Course: " . $student->removeCourse($practicum) . "<br><br>";

$student->enrollmentDetails();


?>



<!-- 

Write an Object Oriented code in PHP that simulates a student object being enrolled and having courses/subjects added under his name. A method that enables deleting of courses should be included in the code. One course should cost 1450 PHP. Upon execution of the code, we should be able to see the total enrollment fee. No need to write an HTML template for this one.  

-->