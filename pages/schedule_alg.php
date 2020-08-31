<?php
// find mathematical equasions for the generation algorithm
// TODO: create restrictions and room availability depending on the hours and days available from each class
// TODO: distribute the lectures evenly throughout the course of two weeks without a brute force aglorithm that places lecetures all together
// NOTE: basic restrictions are hours and days that rooms are available AND hours and days that teachers are available

include("../classes/DB.php");

// TODO: add a link to give data again!!!

// DEBUG: SHOW ERRORS
// TODO: remove this when done
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Lecture{
  public $teacher_name;
  public $class_name;
  public $room_name;
  public $num_students;
  public $days_avail;
  public $hours_avail;

  function set($teacher_name, $class_name, $room_name, $num_students, $days_avail, $hours_avail){
    $this->teacher_name = $teacher_name;
    $this->class_name = $class_name;
    $this->room_name = $room_name ;
    $this->num_students = $num_students;
    $this->days_avail = $days_avail ;
    $this->hours_avail = $hours_avail ;
  }
}

function get_data(){
  $data = DB::query('SELECT * FROM classes', array());
  $classes = array();

  for($i=0 ; $i<count($data) ; $i++){
    $lec = new Lecture;
    $lec->set($data[$i][0], $data[$i][1], $data[$i][2], $data[$i][3], $data[$i][4], $data[$i][5]);
    array_push($classes, $lec);
  } 

  return $classes;
}

function generate(){
  $classes = get_data();
}

// MAIN
if(isset($_GET['generate'])){
  generate();
}
?>

<form>
  <a href='schedule_alg.php?generate=true'><button type="button">Generate Schedule</button></a>
</form>

