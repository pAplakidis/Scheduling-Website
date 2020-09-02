<?php
// find mathematical equasions for the generation algorithm
// TODO: create restrictions and room availability depending on the hours and days available from each class
// TODO: distribute the lectures evenly throughout the course of two weeks without a brute force aglorithm that places lecetures all together
// NOTE: basic restrictions are hours and days that rooms are available AND hours and days that teachers are available

include("../classes/DB.php");

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

// TODO: make this work otherwise all classes are put in one day (or bruteforced)
// TODO: go through all days and pick one that distributes the lectures evenly
// returns an int 1-14 representing the optimal day from a set of available days
function find_opt_day($days, $idxs){

  print_r($idxs);
  echo "<br><br>";

  // for debugging;
  $best_day = $idxs[0];
 
 return $best_day+1;
}

function room_avail_all_day($days, $room){
  // TODO: check which days the given room is available all day and return the day that distributes it best
  // NOTE: for this to work with if statement, return array_idx+1 (1-14)
  $candidate_days = array();  // array of possible days the room can be added

  foreach($days as $idx=>$day){
    if(count($day) == 0){
      array_push($candidate_days, $idx);
    }
    else{
      // loop through day's lectures
      $room_taken = false;
      foreach($day as $i=>$lecture){
        if(strcmp($lecture->room_name, $room) == 0){
          $room_taken = true;
          break;
        }
      }
      if(!$room_taken){
        array_push($candidate_days, $idx);
      }
    }
  }
  return find_opt_day($days, $candidate_days);
}

function create_schedule($classes){
  $days = array();  // week 1: 0-6, week2: 7-13
  $days = array_pad($days, 14, array()); // each day is an array of lecture objects

  // TODO: need to take into account the days and hours avail
  // TODO: evenly distribute lectures for two weeks

  $i = 0;
  foreach($classes as $lecture){
    echo "lecture " . $i . "<br>";
    $i++;

    // TODO: implement the algorithm from algorithm.txt here:
    if($day_idx = room_avail_all_day($days, $lecture->room_name)){
      array_push($days[$day_idx-1], $lecture);
      continue;
    }
    // if the room is taken every day for whatever hours
    else{

    }
  }

  return $days;
}

function print_weeks($days){
  echo "<br><br>";
  print_r($days);
  // TODO: order each day's lecture objects by time
}

function generate(){
  $classes = get_data();
  $days = create_schedule($classes);
  print_weeks($days);
}

// MAIN
if(isset($_GET['generate'])){
  generate();
}
?>

<form>
  <a href='schedule_alg.php?generate=true'><button type="button">Generate Schedule</button></a>
</form>
<a href='schedule_data.php'>Give Data</a>
<br>
<a href='../index.html'>Home</a>
<br>
<a href='menu.html'>Menu</a>

