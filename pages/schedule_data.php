<?php

if(isset($_POST['submit']))
{
  // TODO: need to add room_name to mysql database
  // TODO: check if the fields have values

  $teaher_name = $_POST['teacher_name'];
  $class_name = $_POST['title'];
  // TODO: need to add more parameters here
  $room_name = $_POST['room_name'];

  DB::query('INSERT INTO restrictions VALUES (:teacher_name, :class_name)', array(':techer_name'=>$teacher_name, ':class_name'=>$class_name));
  echo "Restrictions added to database!";
}

?>

<h1>Restrictions</h1><p />
<h2>Submit the following form to enter the limitations of a class</h2><p />
<form class="schedule.js" method="post">
    <input type="text" name="teacher_name" placeholder="Lecturer Name"><p />
    <input type="text" name="title" placeholder="Lecture Title"><p />
    <!-- need to add num_students, days_avail, hours_avail -->
    <input type="text" name="room_name" placeholder="Room Name"><p />
    <input type="submit" name="submit" value="Submit">
</form>

<br><br>

<h2>Or upload a .json file with the restriciton data</h2>
<!-- after uploading the file just open it and upload the data to the sql table -->
<form action='upload.php' method="post" enctype="multipart/form-data">
  Select a json file to upload
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br>
  <input type="submit" value="Upload Image" name="submit">
</form>

