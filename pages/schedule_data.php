<?php
include('../classes/DB.php');

// TODO: work on the upload script (save the file, check parameters, etc)
// TODO: add a Clear Restrictions Button

if(isset($_POST['submit']))
{
  $teacher_name = $_POST['teacher_name'];
  $class_name = $_POST['title'];
  $room_name = $_POST['room_name'];
  $num_students = intval($_POST['num_students']);

  // 0: monday, 1: tuesday, 2: wednesday, 3: thirsday, 4: friday
  $days_avail = "";
  if(isset($_POST['monday']))
  {
    $days_avail .= "0,";
  }
  if(isset($_POST['tuesday']))
  {
    $days_avail .= "1,";
  }
  if(isset($_POST['wednesday']))
  {
    $days_avail .= "2,";
  }
  if(isset($_POST['thursday']))
  {
    $days_avail .= "3,";
  }
  if(isset($_POST['friday']))
  {
    $days_avail .= "4,";
  }
  if($days_avail != ""){
    $days_avail = substr($days_avail, 0, -1);
  }

  if(isset($_POST['start_time']) && isset($_POST['end_time']))
  {
    $hours_avail = $_POST['start_time'] . "," . $_POST['end_time'];
  }


  if(isset($_POST['submit'])){
    DB::query('INSERT INTO classes VALUES (:teacher_name, :class_name, :room_name, :num_students, :days_avail, :hours_avail)', array(':teacher_name'=>$teacher_name, ':class_name'=>$class_name, ':room_name'=>$room_name, ':num_students'=>$num_students, ':days_avail'=>$days_avail, ':hours_avail'=>$hours_avail));
    echo "Restrictions added to database!";
  }
}

// TODO: test this
if(isset($_GET['reset_db'])){
  DB::query('TRUNCATE TABLE classes');
  echo 'All data has been deleted';
}

?>

<h1>Restrictions</h1><p />
<h2>Submit the following form to enter the limitations of a class</h2><p />
<form class="schedule.js" method="post">
    <input type="text" name="teacher_name" placeholder="Lecturer Name"><p />
    <input type="text" name="title" placeholder="Lecture Title"><p />

    <label for="room_name">Choose a classroom you would prefer (not guaranteed, will depend on other lectures)</label>
    <select name="room_name" id="room_name">
      <option value="A1">A1</option>
      <option value="A2">A2</option>
      <option value="A3">A3</option>
      <option value="A4">A4</option>
      <option value="A5">A5</option>
      <option value="A6">A6</option>
    </select> <p />
    
    Number of Students (1 to 500) <input type="number" name="num_students" min="1" max="500"><p />
    
    Days the teacher is available<br>
    <input type="checkbox" name="monday" value="Monday">Monday<br>
    <input type="checkbox" name="tuesday" value="Tuesday">Tuesday<br>
    <input type="checkbox" name="wednesday" value="Wednesday">Wednesday<br>
    <input type="checkbox" name="thursday" value="Thursday">Thursday<br>
    <input type="checkbox" name="friday" value="Friday">Friday<br>
    <p />

    Hours the teacher is available <br> (!!!don't give hours with difference less than 3, need at least 3 hours available!!!)<br>
    From <input type="number" name="start_time" min="8" max="20">
    To <input type ="number" name="end_time" min="9" max="21">
    <p />

    <input type="submit" name="submit" value="Submit">
</form>

<br>

<h2>Or upload a .json file with the restriciton data</h2>
<!-- after uploading the file just open it and upload the data to the sql table -->
<form action='upload.php' method="post" enctype="multipart/form-data">
  Select a json file to upload
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br>
  <input type="submit" value="Upload Image" name="submit">
</form>

<br><br>
<a href="schedule_data.php?reset_db=true"><button type="button">Clear Data</button></a> (WARNING THIS REMOVES THE WHOLE DATA)
<br><br>

<a href='schedule_alg.php'>Go To Generate Schedule</a>
<br>
<a href='../index.html'>Home</a>
<br>
<a href='menu.html'>Menu</a>

