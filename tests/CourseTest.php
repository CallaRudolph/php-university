<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";

    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
        }


        function testGetCourseName()
        {
            //Arrange
            $course_name = "history";
            $number = "2332";
            $test_course = new Course($course_name, $number);

            //Act
            $result = $test_course->getCourseName();

            //Assert
            $this->assertEquals($course_name, $result);
        }

        function testSetCourseName()
        {
            $course_name = "Law";
            $number = "400";
            $test_course = new Course($course_name, $number);
            $new_course_name = "Lawsd";

            $test_course->setCourseName($new_course_name);
            $result = $test_course->getCourseName();

            $this->assertEquals($new_course_name, $result);
        }

        function testGetNumber()
        {
            $course_name = "English";
            $number = "666";
            $test_course = new Course($course_name, $number);

            $result = $test_course->getNumber();

            $this->assertEquals($number, $result);
        }

        function testSetNumber()
        {
            $course_name = "Anatomy";
            $number = "3434";
            $test_course = new Course($course_name, $number);
            $new_number = "Jo Boi Day";

            $test_course->setNumber($new_number);
            $result = $test_course->getNumber();

            $this->assertEquals($new_number, $result);
        }

        function testGetId()
        {
            $course_name = "Lolli";
            $number = "3434";
            $test_course = new Course($course_name, $number);
            $test_course->save();

            $result = $test_course->getId();

            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            $course_name = "Geology";
            $number = "3434";
            $test_course = new Course($course_name, $number);
            $test_course->save();

            $executed = $test_course->save();

            $this->assertTrue($executed, "Course not successfully saved to database");
        }

        function testGetAll()
        {
            $course_name = "Underwater BasketWeaving";
            $course_name_2 = "Water Bolo";
            $number = "2433";
            $number_2 = "34343";
            $test_course = new Course($course_name, $number);
            $test_course->save();
            $test_course_2 = new Course($course_name_2, $number_2);
            $test_course_2->save();

            $result = Course::getAll();

            $this->assertEquals([$test_course, $test_course_2], $result);
        }

        function testDeleteAll()
        {
            $course_name = "Soils";
            $course_name_2 = "Chemistry";
            $number = "24333";
            $number_2 = "666";
            $test_course = new Course($course_name, $number);
            $test_course->save();
            $test_course_2 = new Course($course_name_2, $number_2);
            $test_course_2->save();

            Course::deleteAll();

            $result = Course::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            $course_name = "Chemistry";
            $course_name_2 = "Lib Studies";
            $number = "2444";
            $number_2 = "343453";
            $test_course = new Course($course_name, $number);
            $test_course->save();
            $test_course_2 = new Course($course_name_2, $number_2);
            $test_course_2->save();

            $result = Course::find($test_course->getId());

            $this->assertEquals($test_course, $result);
        }

        function testUpdate()
        {
            $course_name = "Gym";
            $number = "101";
            $test_course = new Course($course_name, $number);
            $test_course->save();

            $new_course_name = "Skydiving";

            $test_course->update($new_course_name);

            $this->assertEquals("Skydiving", $test_course->getCourseName());
        }
    }
?>
