<?php
include("../classes/DB.php");

// find mathematical equasions for the generation algorithm
// NOTE: basic restrictions are hours and days that rooms are available AND hours and days that teachers are available
// TODO: test this code with different cases of lectures

// DEBUG: SHOW ERRORS
// TODO: comment this out when done
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

// go through all days and pick one that distributes the lectures evenly
// returns an int 1-14 representing the optimal day from a set of available days
function find_opt_day($days, $idxs){

  //  find the days, sort them from the least lectures to the most, pick the 1st/least_lectures day to put the class
  $sorted_idxs = array();   // 2D array [idx, num_lectures] needs to be sorted by num_lectures

  // count how many lectures each day has
  foreach($days as $idx=>$day){
    if(in_array($idx, $idxs)){
      $num_lectures = count($day);  // number of lectures in a day
      array_push($sorted_idxs, array("idx"=>$idx, "lectures"=>$num_lectures));
    }
  }
  array_multisort(array_column($sorted_idxs, "lectures"), SORT_ASC, $sorted_idxs);

  // for debugging
  //print_r($sorted_idxs);
  //echo "<br><br>";

  $best_day = $sorted_idxs[0]["idx"];
 
  echo "==Preferred Day: " . $best_day . '<br><br>';
  return $best_day+1;
}

// check which days the given room is available all day and return the day that distributes it best
function room_avail_all_day($days, $room){
  // NOTE: for this to work with if statement, return array_idx+1 (1-14)
  $candidate_days = array();  // array of possible days the room can be added

  foreach($days as $idx=>$day){
    if(count($day) == 0){
      array_push($candidate_days, $idx);
    }
    else{
      // loop through day's lectures
      $room_taken = false;
      foreach($day as $lecture){
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

// find if a room is available at all
// NOTE: a room is full all day if it has 4 lectures
function room_avail($days, $room){
  $candidate_days = array();

  foreach($days as $idx=>$day){
    $cnt_classes = 0; // number of classes that take place in the same room in one day

    foreach($day as $lecture){
      if(strcmp($lecture->room_name, $room) == 0){
        $cnt_classes++;
      }
    }
    if($cnt_classes < 4){
      array_push($candidate_days, $idx);
    }
  }
  return find_opt_day($days, $candidate_days);
}

// TODO: check for whatever classroom is available (worst case, put the lecture wherever you can)
// this needs to check if a day has less than 4 lectures * 6 rooms = 24 lectures in total (need to assign the new room to the lecture, need to find the new room as well!!!)(find_opt_day will be used as well)
function check_worst_case($days){
  
}

// TODO: need to solve the problem of TIME (every lecture is 3 hours, need to distribute it)
// need to take into account the days and hours avail
// solution: get the classes in rooms and then assign hours depending on the available hours of the teachers + the remaining hours left in the day
function assign_hours($days){
  // TODO: this adds an hours range next to every lecture in every day (days[day[lecture, hours]])(how do i make it work???)
  // days(day(lectures(lecture, hours))) !!!need to meddle with the array a bit!!!

  return $days;
}

// TODO: refactor this, O(n^3)
function create_schedule($classes){
  $days = array();  // week 1: 0-6, week2: 7-13
  $days = array_pad($days, 14, array()); // each day is an array of lecture objects

  $i = 0;
  foreach($classes as $lecture){
    echo "lecture " . $i . "<br>";
    $i++;

    if($day_idx = room_avail_all_day($days, $lecture->room_name)){
      array_push($days[$day_idx-1], $lecture);
      continue;
    }
    // if the room is taken every day for whatever hours
    else{
      if(($day_idx = room_avail($days, $lecture->room_name))){
        array_push($days[$day_idx-1], $lecture);
        continue;
      }
      else{
        if(($day_idx = check_worst_case($days))){
          array_push($days[$day_idx-1], $lecture);
          continue;
        }
      }
    }

    // if no free day can be found
  }

  $days = assign_hours($days);
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

