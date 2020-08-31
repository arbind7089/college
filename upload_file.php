<?php

if(!isset($_SESSION)){ 
  session_start(); 
}  
include_once 'class.php';  
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000000000000000000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
      $id = $_SESSION['id'];
      if (file_exists("profile/" . $id.'.png')){
        unlink("profile/".$id.'.png');
      } elseif (file_exists("profile/" . $id.'.gif')) {
        unlink("profile/".$id.'.gif');
      } elseif (file_exists("profile/" . $id.'.jpeg')) {
        unlink("profile/".$id.'.jpeg');
      } elseif (file_exists("profile/" . $id.'.jpg')) {
        unlink("profile/".$id.'.jpg');
      } elseif (file_exists("/profile/" . $id.'.pjpeg')) {
        unlink("profile/".$id.'.pjpeg');
      }

      $temp = explode(".", $_FILES["file"]["name"]);
      $newfilename = $_SESSION['id'] . '.' . end($temp);
      move_uploaded_file($_FILES["file"]["tmp_name"], "../college/profile/" . $newfilename); 

      header("location:profile.php");      
    }
  }
else
  {
  echo "Invalid file";
  }
?>