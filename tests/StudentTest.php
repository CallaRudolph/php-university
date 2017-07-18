<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";


    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }


        function testGetName()
        {
            //Arrange
            $name = "Bobby";
            $date = "08-23-2017";
            $test_student = new Student($name, $date);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            $name = "Suzie";
            $date = "3434";
            $test_student = new Student($name, $date);
            $new_name = "Johnny";

            $test_student->setName($new_name);
            $result = $test_student->getName();

            $this->assertEquals($new_name, $result);
        }

        function testGetDate()
        {
            $name = "Lucy";
            $date = "7-10-2017";
            $test_student = new Student($name, $date);

            $result = $test_student->getDate();

            $this->assertEquals($date, $result);
        }

        function testSetDate()
        {
            $name = "Lolli";
            $date = "3434";
            $test_student = new Student($name, $date);
            $new_date = "Jo Boi Day";

            $test_student->setDate($new_date);
            $result = $test_student->getDate();

            $this->assertEquals($new_date, $result);
        }

        function testGetId()
        {
            $name = "Lolli";
            $date = "3434";
            $test_student = new Student($name, $date);
            $test_student->save();

            $result = $test_student->getId();

            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            $name = "Lolli";
            $date = "3434";
            $test_student = new Student($name, $date);
            $test_student->save();

            $executed = $test_student->save();

            $this->assertTrue($executed, "Student not successfully saved to database");
        }

        function testGetAll()
        {
            $name = "Boblob";
            $name_2 = "Lobobo";
            $date = "24/7";
            $date_2 = "Never";
            $test_student = new Student($name, $date);
            $test_student->save();
            $test_student_2 = new Student($name_2, $date_2);
            $test_student_2->save();

            $result = Student::getAll();

            $this->assertEquals([$test_student, $test_student_2], $result);
        }

        function testDeleteAll()
        {
            $name = "Boblob";
            $name_2 = "Lobobo";
            $date = "24/7";
            $date_2 = "Never";
            $test_student = new Student($name, $date);
            $test_student->save();
            $test_student_2 = new Student($name_2, $date_2);
            $test_student_2->save();

            Student::deleteAll();

            $result = Student::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            $name = "Boblob";
            $name_2 = "Lobobo";
            $date = "24/7";
            $date_2 = "Never";
            $test_student = new Student($name, $date);
            $test_student->save();
            $test_student_2 = new Student($name_2, $date_2);
            $test_student_2->save();

            $result = Student::find($test_student->getId());

            $this->assertEquals($test_student, $result);
        }

        function testUpdate()
        {
            $name = "Lolli";
            $date = "3434";
            $test_student = new Student($name, $date);
            $test_student->save();

            $new_name = "Mitchell";

            $test_student->update($new_name);

            $this->assertEquals("Mitchell", $test_student->getName());
        }

        function testDelete()
        {
            $name = "Boblob";
            $date = "24/7";
            $test_student = new Student($name, $date);
            $test_student->save();

            $course_name = "anatomy";
            $number = "101";
            $test_course = new Course($course_name, $number);
            $test_course->save();

            $test_course->addStudent($test_course);
            $test_course->delete();

            $this->assertEquals([], $test_course->getStudents());

        }

        function testAddCourse()
        {
            $name = "Boblob";
            $date = "24/7";
            $test_student = new Student($name, $date);
            $test_student->save();

            $course_name = "anatomy";
            $number = "888";
            $test_course = new Course($course_name, $number);
            $test_course->save();

            $test_student->addCourse($test_course);

            $this->assertEquals($test_student->getCourses(), [$test_course]);
        }

        function testGetCourses()
        {
            $name = "Boblob";
            $date = "24/7";
            $test_student = new Student($name, $date);
            $test_student->save();

            $course_name = "Chemistry";
            $course_name_2 = "Lib Studies";
            $number = "2444";
            $number_2 = "343453";
            $test_course = new Course($course_name, $number);
            $test_course->save();
            $test_course_2 = new Course($course_name_2, $number_2);
            $test_course_2->save();

            $test_student->addCourse($test_course);
            $test_student->addCourse($test_course_2);

            $this->assertEquals($test_student->getCourses(), [$test_course, $test_course_2]);
        }
    }
?>
