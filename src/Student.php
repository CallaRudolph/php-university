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

    // function getId()
    // {
    //     // return $this->id;
    // }

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
}
?>
