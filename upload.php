<?php

//require 'connection.php';


//if we clicked on Upload button
if($_POST['upload'] == 'upload')

  {

if(!isset($_FILES['ufile']['name'])){
	$error="-Select a file to upload";
	echo $error;
	return;
}
  //make the allowed extensions

  $goodExtensions = array('.doc','.docx','.txt','.pdf',); 

  $error='';

  //set the current directory where you wanna upload the doc/docx files
  
  // ====================================================================================================

  // Year
     $sendername = trim($_POST["fname"]);
     $senderemail=$_POST["email"];
  $year = $_POST["year"];
  // ====================================================================================================
  
  // Division
  $division=$_POST["div"];
  // ====================================================================================================
  $cat =$_POST['cat'];
  // Category$ 

      switch($cat)
     {
        case 'ENG'   :  $uploaddir = 'Files/Eng/';
                            break;
        case 'HIN'     :  $uploaddir = 'Files/Hin/';
                            break;                         
        case 'MAR'   :  $uploaddir = 'Files/Mar/';
                            break;
        case 'TECH' :  $uploaddir = 'Files/Tech/';
                            break;
     }

  // ====================================================================================================

 
  $name = $_FILES['ufile']['name'];//get the name of the file that will be uploaded
  $max_filesize=2000000;//set up a minimum file size

  $stem=substr($name,0,strpos($name,'.'));

  //take the file extension

  $extension = substr($name, strpos($name,'.'), strlen($name)-1);

  //verify if the file extension is valid or not

   if(!in_array($extension,$goodExtensions))

     $error.='-Extension not allowed<br>';

 //verify if the file size of the file being uploaded is greater then 1

   if(filesize($_FILES['ufile']['tmp_name']) > $max_filesize)

     $error.='-File size too large<br>'."\n";

  $uploadfile = $uploaddir . $stem.$extension;
$filename=$stem.$extension;
if ($error=='')

{

//upload the file to

if (move_uploaded_file($_FILES['ufile']['tmp_name'], $uploadfile)) {
     $sql = "INSERT INTO articles (name, email,year,division,category,filename) VALUES ('$sendername','$senderemail','$year','$division','$cat','$name')";

      if ($conn->query($sql) === TRUE) {

            echo '1';
      } 
      else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
         

}

}

else echo $error;

}

?>