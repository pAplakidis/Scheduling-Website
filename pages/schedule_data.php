<?php

# TODO: modify this to fit the new database

if(isset($_POST['submit']))
{
  // TODO: check if the fields have values
  // TODO: add an id to classes in databasee 
  $teaher_name = $_POST['teacher_name'];
  $class_name = $_POST['title'];
  $num_students = $_POST['num_students'];

  $days_avail = array();

  if(isset($_POST['monday']))
  {
    array_push($days_avail, "monday");
  }
  
  if(isset($_POST['tuesday']))
  {
    array_push($days_avail, "tuesday");
  }

   if(isset($_POST['wednesday']))
  {
    array_push($days_avail, "wednesday");
  }

 if(isset($_POST['thursday']))
  {
    array_push($days_avail, "thursday");
  }
 
  if(isset($_POST['friday']))
  {
    array_push($days_avail, "friday");
  }

  if(isset($_POST['start_time']) && isset($_POST['end_time']))
  {
    $hours_avail = array($start_time, $end_time); 
  }

  $room_name = $_POST['room_name'];

  // TODO: find a way to insert array into database
  DB::query('INSERT INTO classes VALUES (:teacher_name, :class_name, :num_students, :days_avail, :hours_avail, :room_name)', array(':techer_name'=>$teacher_name, ':class_name'=>$class_name, ':num_students'=>$num_students, ':days_avail'=>$days_avail, ':hours_avail'=>$hours_avail, ':room_name'=>$room_name));
  echo "Restrictions added to database!";
}

?>

<h1>Restrictions</h1><p />
<h2>Submit the following form to enter the limitations of a class</h2><p />
<form class="schedule.js" method="post">
    <input type="text" name="teacher_name" placeholder="Lecturer Name"><p />
    <input type="text" name="title" placeholder="Lecture Title"><p />
    Number of Students (1 to 500) <input type="number" name="num_students" min="1" max="500"><p />
    
    Days the teacher is available<br>
    <input type="checkbox" name="monday" value="Monday">Monday<br>
    <input type="checkbox" name="tuesday" value="Tuesday">Tuesday<br>
    <input type="checkbox" name="wednesday" value="Wednesday">Wednesday<br>
    <input type="checkbox" name="thursday" value="Thursday">Thursday<br>
    <input type="checkbox" name="friday" value="Friday">Friday<br>
    <p />

    Hours the teacher is available<br>
    From <input type="number" name="start_time" min="8" max="20">
    To <input type ="number" name="end_time" min="9" max="21">
    <p />

    <input type="text" name="room_name" placeholder="Room Name"><p />
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

