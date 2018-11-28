 <?php include("config.php");

   @ $db=new mysqli($dbserver,$dbuser,$dbpass,$dbname);//create database

     if($db->connect_error){
          echo "Sorry, couldn't connect, the reason is:".$db->connect_error;
              exit();
      }//if haven't connect




 ?>


<!DOCTYPE html>
<html>
<head>
      <title>Tingmo Liu (Yimo)</title>
      <link rel="stylesheet" type="text/css" href="main.css">
</head>
<header>
	 
      <h1>Tingmo Liu (Yimo)</h1>
            <nav class="menu">
		          <ul>
		            <li>
		              <a href="about.php" class="<?php echo($current_page =='about.php')?'active':NULL?>">About</a>
		            </li>
		            <li>
		              <a href="index.php" class="<?php echo($current_page =='index.php'||$current_page=='') ?'active':NULL?>">Architecture Gallery</a>
		            </li>
		            <?php 
                         if ($_SESSION['usertype']=="normal_user"||$_SESSION['usertype']=="moderator") {
                                echo "<li><a href='like.php' class=' echo($current_page =='like.php')?active:NULL'>Like</a></li>";
	                     }
                    ?>
                       
                   
		            <li>
		              <a href="user.php" class="<?php echo($current_page =='user.php')?'active':NULL?>">Login</a>
		            </li>
		            <li>
		              <a href="contact.php" class="<?php echo($current_page =='contact.php')?'active':NULL?>">Contact</a>
		            </li>
		          </ul>
            </nav>
</header>