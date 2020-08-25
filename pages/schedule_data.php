<?php
include('../classes/DB.php');

// TODO: work on the upload script (save the file, check parameters, etc)
if(isset($_POST['submit']))
{
  $teaher_name = $_POST['teacher_name'];
  $class_name = $_POST['title'];
  $room_name = $_POST['room_name'];
  $num_students = $_POST['num_students'];

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

  if(isset($_POST['start_time']) && isset($_POST['end_time']))
  {
    $hours_avail = $start_time . "," . $end_time;
  }


  // TODO: debug this query (error 500)
  /*
    ERROR MESSAGE:
    PHP Warning:  Uncaught PDOException: SQLSTATE[HY093]: Invalid parameter number: parameter was not defined in /home/paul/dev/university/Scheduling-Website/classes/DB.php:17
    Stack trace:
    #0 /home/paul/dev/university/Scheduling-Website/classes/DB.php(17): PDOStatement->execute(Array)
    #1 php shell code(1): DB::query('INSERT INTO cla...', Array)
    #2 {main}
      thrown in /home/paul/dev/university/Scheduling-Website/classes/DB.php on line 17
  */
  if(isset($_POST['submit'])){
    DB::query('INSERT INTO classes VALUES (:teacher_name, :class_name, :room_name, :num_students, :days_avail, :hours_avail)', array(':teacher_name'=>$teacher_name, ':class_name'=>$class_name, ':room_name'=>$room_name, ':num_students'=>$num_students, ':days_avail'=>$days_avail, ':hours_avail'=>$hours_avail));
    echo "Restrictions added to database!";
  }
}

?>

<h1>Restrictions</h1><p />
<h2>Submit the following form to enter the limitations of a class</h2><p />
<form class="schedule.js" method="post">
    <input type="text" name="teacher_name" placeholder="Lecturer Name"><p />
    <input type="text" name="title" placeholder="Lecture Title"><p />
    <input type="text" name="room_name" placeholder="Room Name"><p />
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

