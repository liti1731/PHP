<?php include("../others/config.php");
     @ $db=new mysqli($dbserver,$dbuser,$dbpass,$dbname);//create database

     if($db->connect_error){
          echo "Sorry, couldn't connect, the reason is:".$db->connect_error;
              exit();
      }
ini_set("display_errors", 1);
ini_set("track_errors",1);
ini_set("html_errors", 1);
ERROR_REPORTING(E_ALL);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tingmo Liu (Yimo)</title>
      <link rel="stylesheet" type="text/css" href="../main.css">

</head>
<?php
      if (isset($_GET)&& !empty($_GET)) {
          $editID=$_GET['edit'];
      }
	      $query="SELECT Project.project_ID,Project.project_Name,Type.type_ID,Tool.tool_ID,Project.date,Project.comment,Pic.pic_destination FROM Project
	        JOIN Type ON Project.type_ID=Type.type_ID
	        JOIN link_PT ON Project.project_ID=link_PT.project_ID
	        JOIN Tool ON Tool.tool_ID=link_PT.tool_ID
	        JOIN link_PP ON Project.project_ID=link_PP.project_ID
	        JOIN Pic ON link_PP.pic_ID=Pic.pic_ID
	        WHERE Project.project_ID=$editID";
	        //select all we need
           
            $stmt= $db -> prepare($query);
	        $stmt->bind_result($id,$name,$type,$tool,$date,$comment,$picDestination);
	        $stmt->execute();
	        $stmt->fetch();//?when use fetch
	        echo $type;
?>

<body>
	<main>
        <h2>Edit your project</h2>
        <?php  
          echo '<form action="update.php" method="post" enctype="multipart/form-data">
            <div>
        		   <p>Date</p>
      	   	   <input name="dateU" type="text" value="'.$date.'"   />

        		</div>
        		<div>
        		   <p>Design Name</p>
      	   	   <input name="nameU" type="text" value="'.$name.'"/>
        		</div>
            <div>
            	   <p>The type</p>
      	   	     <select name="typeU" value="'.$type.'"/><!---???????how to manage drop selection pre-set------->
                    <option value="1" >Graphic design assignment</option>
                    <option value="2">Graphic design project</option>
                    <option value="3">Coding assignment</option>
                    <option value="4">Coding project</option>
                  </select>
            </div> 
            <div>
                 <p>The tool</p>
                 <select name="toolU">
                    <option value="1">AI</option>
                    <option value="7">ID</option>
                    <option value="2">PS</option>
                    <option value="8">HTML+CSS</option>
                    <option value="9">JAVASCRIPT</option>
                    <option value="10">PHP</option>
                  </select>
            </div>  
            <div>
            	   <p>Comment</p>
      	   	   <input name="commentU" type="text" value="'.$comment.'"/>
            </div>
            <div>
                 <p>Select Pictures</p>
                 <input name="uploadPic" type="file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" value="pics/1.jpg"/>  <!---???????how to manage pic upload pre-set------->
                 <br/>
                 <br/>
      	   	   <input name="uploadButton" type="submit" value="Upload" />
      	</form>' ; 
            
         ?>

	   
    </main>
	
</body>
<?php include("../others/footer.php");?> 