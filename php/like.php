<?php include("others/header.php");?>
<body>
  <main>
  	<div class="boxContainer">
	  	<?php  

	  		 if (isset($_GET)&& !empty($_GET)) {
	           $query2 = "UPDATE Project SET liked='0'  WHERE project_ID=".$_GET['like']; 
	           $stmt2= $db->prepare($query2);
	           $stmt2->execute();
	      }



	  	    $query="SELECT Project.project_ID,Project.project_Name,Type.type_Name,Tool.tool_Name,Project.date,Project.comment,Project.liked FROM Project
	        JOIN Type ON Project.type_ID=Type.type_ID
	        JOIN link_PT ON Project.project_ID=link_PT.project_ID
	        JOIN Tool ON Tool.tool_ID=link_PT.tool_ID";//select all

	        $stmt= $db->prepare($query);
	        $stmt->bind_result($id,$name,$type,$tool,$date,$comment,$liked);
	        $stmt->execute();//launch
	       
	  	 	while ($stmt->fetch()) {
	  	 		if($liked==1){
	                      echo "<div id='box'>";
	                      echo "<h3>$id</h3>";
	                      echo "<h3>$name</h3>";
	                      echo "<h4>$date</h4>";
	                      echo "<h4>$type $tool</h4>";
	                      echo "<p>$comment<p>";
	                      echo "<form method='GET' ><button name='like' value='$id'>Unlike</button></form>";
	                      echo "</div>";}
	        }
	     ?>
    </div>
  <main/>
</body>
<?php include("others/footer.php");?>
   
