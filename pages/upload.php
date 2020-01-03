<?php
// NOTE: this might be vulnerable to malicious file upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

echo "type: $filetype";

$allowed = array('json');

// check if it is a json file
if(isset($_POST['submit']))
{
  if(!in_array($fileType))
  {
    echo "Wrong file extension detected!";
    $uploadOk = 0;
  }
  else
  {
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file))
    {
      echo "File uploaded!";
      echo "<br>Uploading to database";
    }
    else
    {
      echo "There was an error uploading the file!";
    }
  }
}

function load_to_db()
{

}
?>
