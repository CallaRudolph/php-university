<?php
class Course
{
    private $course_name;
    private $number;
    private $id;

    function __construct($course_name, $number, $id = null)
    {
        $this->course_name = $course_name;
        $this->number = $number;
        $this->id = $id;
    }


    function getCourseName()
    {
        return $this->course_name;
    }

    function setCourseName($new_course_name)
    {
        $this->course_name = (string) $new_course_name;
    }

    function getNumber()
    {
        return $this->number;
    }

    function setNumber($new_number)
    {
        $this->number = (string) $new_number;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO courses (course_name, number) VALUES ('{$this->getCourseName()}', '{$this->getNumber()}')");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
        $courses = array();
        foreach($returned_courses as $course) {
            $course_name = $course['course_name'];
            $number = $course['number'];
            $id = $course['id'];
            $new_course = new Course($course_name, $number, $id);
            array_push($courses, $new_course);
        }
        return $courses;
    }

    static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM courses;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    static function find($search_id)
    {
        $found_course = null;
        $returned_courses = $GLOBALS['DB']->prepare("SELECT * FROM courses WHERE id = :id");
        $returned_courses->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_courses->execute();
        foreach($returned_courses as $course) {
            $course_name = $course['course_name'];
            $number = $course['number'];
            $id = $course['id'];
            if ($id == $search_id) {
                $found_course = new Course($course_name, $number, $id);
            }
        }
        return $found_course;
    }

    function update($new_course_name)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE courses SET course_name = '{$new_course_name}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setCourseName($new_course_name);
            return true;
        } else {
            return false;
        }
    }

    function updateNumber($new_course_number)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE courses SET number = '{$new_course_number}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setNumber($new_course_number);
            return true;
        } else {
            return false;
        }
    }

    function delete()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
        if (!$executed) {
            return false;
        }
        $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE course_id = {$this->getId()};");
        if (!$executed) {
            return false;
        } else {
            return true;
        }
    }

    function addStudent($student)
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    function getStudents()
    {
        $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses JOIN courses_students ON (courses_students.course_id = courses.id) JOIN students ON (students.id = courses_students.student_id) WHERE courses.id = {$this->getId()};");
        $students = array();
        foreach($returned_students as $student) {
            $name = $student['name'];
            $date = $student['date'];
            $id = $student['id'];
            $new_student = new Student($name, $date, $id);
            array_push($students, $new_student);
        }
        return $students;
    }
}
?>
