<?php

if(isset($_POST['submit']))
{
  
}

?>

<h1>Restrictions</h1><p />
<h2>Submit the following form to enter the limitations of a class</h2><p />
<form class="schedule.js" method="post">
    <input type="text" name="teacher_name" placeholder="Lecturer Name"><p />
    <input type="text" name="title" placeholder="Lecture Title"><p />
    <input type="text" name="room_name" placeholder="Room Name"><p />
    <input type="submit" name="submit" value="Submit">
</form>

<br><br>
<h2>Or upload a .json file with the restriciton data</h2>
