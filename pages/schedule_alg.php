<?php
// find mathematical equasions for the generation algorithm
// TODO: create restrictions and room availability depending on the hours and days available from each class
// TODO: distribute the lectures evenly throughout the course of two weeks without a brute force aglorithm that places lecetures all together
// NOTE: basic restrictions are hours and days that rooms are available AND hours and days that teachers are available

class Lecture{
  public $teacher_name;
  public $class_name;
  public $room_name;
  public $num_students;
  public $days_avail;
  public $hours_avail;
}

// TODO: this might be a big file, so modularize it maybe

function generate(){
  // TODO: get classes data from DB
  // use select attributes and assign them to arrays or something

  // BUG: this returns nothing???
  $num_classes = intval(DB::query('SELECT COUNT(*) FROM classes', array()));
  echo $num_classes;

  $classes = array();
  for($i=0;$i<$num_classes;$i++){
    // TODO: create Lecture objects and assign values from them taken from the database
    // TODO: use array_push to add Lecture objects to $classes
  }
}

// MAIN
if(isset($_POST['generate'])){
  generate();
}
?>

<form>
  <!-- <input type="button" name="generate" placeholder="Generate Schedule"> -->
  <input type="submit" name="generate" value="Generate Schedule"/>
</form>
