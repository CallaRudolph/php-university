<?php
class Student
{
    private $name;
    private $date;
    private $id;

    function __construct($name, $date, $id = null)
    {
        $this->name = $name;
        $this->date = $date;
        $this->id = $id;
    }


    function getName()
    {
        return $this->name;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getDate()
    {
        return $this->date;
    }

    function setDate($new_date)
    {
        $this->date = (string) $new_date;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO students (name, date) VALUES ('{$this->getName()}', '{$this->getDate()}')");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
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

    static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM students;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    static function find($search_id)
    {
        $found_student = null;
        $returned_students = $GLOBALS['DB']->prepare("SELECT * FROM students WHERE id = :id");
        $returned_students->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_students->execute();
        foreach($returned_students as $student) {
            $name = $student['name'];
            $date = $student['date'];
            $id = $student['id'];
            if ($id == $search_id) {
                $found_student = new Student($name, $date, $id);
            }
        }
        return $found_student;
    }

    function update($new_name)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setName($new_name);
            return true;
        } else {
            return false;
        }
    }

    // function delete()
    //    {
    //        $executed = $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
    //        if (!$executed) {
    //            return false;
    //        }
    //        $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE course_id = {$this->getId()};");
    //        if (!$executed) {
    //            return false;
    //        } else {
    //            return true;
    //        }
    //    }
}
?>
