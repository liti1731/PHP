<?php

ini_set("display_errors", 1);
ini_set("track_errors",1);
ini_set("html_errors", 1);
ERROR_REPORTING(E_ALL);


include("../others/config.php");
@ $db = new mysqli($dbserver,$dbuser,$dbpass,$dbname);//create database
if($db->connect_error){
  echo "Sorry, couldn't connect, the reason is:".$db->connect_error;
      exit();
}//connect db

	

//get input
if (isset($_POST)) {
    $uploadDate=trim($_POST["dateU"]);
    $uploadName=trim($_POST["nameU"]);
    $uploadType=$_POST["typeU"];
    $uploadTool=$_POST["toolU"];
    $uploadComment=trim($_POST["commentU"]);//get type-in input
    $file=$_FILES["uploadPic"];
    $fileName=$_FILES["uploadPic"]["name"];
    $fileTmpName=$_FILES["uploadPic"]["tmp_name"];//tep location
    $fileSize=$_FILES["uploadPic"]["size"];
    $fileError=$_FILES["uploadPic"]["error"];// if error, number
    $fileType=$_FILES["uploadPic"]["type"];//get different values

    $fileExt=explode('.', $fileName);
    $fileActualExt=strtolower(end($fileExt));//get small case type of pic
    $allowed=array('jpg','jpeg','pdf','png');//pic type limit
    $valid=true;

   


//all limitation
    if (!in_array($fileActualExt, $allowed)) {
         echo "You cannot upload this type of pics.";
         $valid=false;
    }//if type allow to upload
    if (!$fileError==0) {
         echo"You could not upload it because there is a error.";
         $valid=false;
    }//check if there is error with pic
    if ($fileSize>1000000) {
	     echo "The pic is too big.";
	     $valid=false;
    }//check if pic bigger than 1000mb  

    if ($valid) {
	     $finalName=$uploadName.".".$fileActualExt;
	     $destination='pics/'.$finalName;
	     move_uploaded_file($fileTmpName, "../".$destination);//upload actual pic to pics folder//..no need to get out for index page
	      
	     $query="INSERT INTO Pic (pic_Name,pic_destination) VALUES ('$finalName','$destination')";
       $stmt= $db->prepare($query);
		   $stmt->execute(); // upload pic info to db Pic table

       $lastPicID= $db->insert_id;//get last id
       

       echo $lastPicID;
		   $query2="INSERT INTO Project (project_Name,type_ID,date,comment,liked) VALUES ('$uploadName','$uploadType','$uploadDate','$uploadComment','0')";
       $stmt2= $db->prepare($query2);
		   $stmt2->execute();// insert to main project table 
          
       $lastID= $db->insert_id;

       $query3="INSERT INTO link_PT (project_ID,tool_ID) VALUES ('$lastID','$uploadTool')";
       $stmt3= $db->prepare($query3);
       $stmt3->execute();// insert to link_PT table 
      

		   $query4="INSERT INTO link_PP (project_ID,pic_ID) VALUES ('$lastID','$lastPicID')";
       $stmt4= $db->prepare($query4);
		   $stmt4->execute();// insert to link_PP table 
	     header("location:../index.php");
	     echo "Successfully upload!";

	}// if succeed  
	    
}

 ?>

