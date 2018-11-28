<?php include("others/header.php");

ini_set("display_errors", 1);
ini_set("track_errors",1);
ini_set("html_errors", 1);
ERROR_REPORTING(E_ALL);
$searchname='';
$searchtype='';

       if (isset($_GET)&& !empty($_GET)) {
           $query2 = "UPDATE Project SET liked='1'  WHERE project_ID=".$_GET['like']; 
           $stmt2= $db->prepare($query2);
           $stmt2->execute();
      }//+get liked or not 
     
      
        if (isset($_POST) && !empty($_POST)) {
          $searchname=trim($_POST["projectName"]);
          $searchname=htmlentities($searchname);
          $searchtype=trim($_POST["projectType"]);
          $searchtype=htmlentities($searchtype);
      }//get input
       
       $query="SELECT Project.project_ID,Project.project_Name,Type.type_ID,Tool.tool_ID,Project.date,Project.comment,Project.liked,Pic.pic_destination FROM Project
        JOIN Type ON Project.type_ID=Type.type_ID
        JOIN link_PT ON Project.project_ID=link_PT.project_ID
        JOIN Tool ON Tool.tool_ID=link_PT.tool_ID
        JOIN link_PP ON Project.project_ID=link_PP.project_ID
        JOIN Pic ON link_PP.pic_ID=Pic.pic_ID";
        //select all we need



       if($searchname && !$searchtype){
           $query=$query." WHERE Project.project_Name LIKE '%".$searchname."%'";
       }
       if(!$searchname && $searchtype){
           $query=$query." WHERE Type.type_ID LIKE '%".$searchtype."%'";
       }
       if($searchname && $searchtype){
           $query=$query." WHERE Project.project_Name LIKE '%".$searchname."%' AND Type.type_Name LIKE '%".$searchtype."%'";
       }//decide which value we are gonna use to show


        $stmt= $db->prepare($query); 
        $stmt->bind_result($id,$name,$type,$tool,$date,$comment,$liked,$picDestination);
        $stmt->execute();//launch
        $stmt->fetch();
        

        
?>

<body>
  <main>
      <div class="search">
  	    	<form method="post">
              <div class="name">
		             <p>Name</p>
		             <input name="projectName" type="text"/>
		          </div>
              <div class="type">
                <p>Type</p>
		            <input name="projectType" type="text"/> 
		          </div> 

              <input  type="submit" value="search"/>
	        </form>
  	    </div>
	        
        <div class="boxContainer">
             <?php  
                 while ($stmt->fetch()) {
                        echo "<div id='box'>";
                        echo "<img src='".$picDestination."'>";
                        echo "<h4>$name</h4>";
                        echo "<h4>$date</h4>";
                        echo "<h4>$tool</h4>";
                        echo "<h4>$type</h4>";
                        echo "<p>$comment<p>";
                        if ($_SESSION['usertype']=="normal_user"||$_SESSION['usertype']=="moderator") {
                                echo "<form method='GET' ><button name='like' value='$id'>Like</button></form>";
                       }
                       if ($_SESSION['usertype']=="moderator") {
                                echo "<form action='moderator/edit.php' method='GET' ><button name='edit' value='$id'>Edit</button></form>";
                       }
                        echo "</div>";
                 }
             ?>
        </div>
  </main>    
</body>
<?php include("others/footer.php");?> 
