<?php include("others/header.php");

     $loginUsername="";
     $loginPassword="";
     $tester=0;

     if (isset($_POST) && !empty($_POST)) { 
     	 $loginUsername=trim(mysqli_real_escape_string($db, $_POST["username"]));
         $loginPassword=trim(mysqli_real_escape_string($db, $_POST["password"]));// get input and prevent sql injection



         $query = "SELECT user_ID,user_type,user_name,user_password FROM User WHERE user_name='".$loginUsername."' and user_password='".$loginPassword."'";//get wanted users info

   
	     $stmt= $db->prepare($query);
	     $stmt->bind_result($userID,$userType,$username,$password);
	     $stmt->execute();

	     if ($stmt->fetch()>0){
	     	$_SESSION['username']=$username;
	     	$_SESSION['usertype']=$userType;

	     	if ($_SESSION['usertype']=="admin") {
	     		header("admin/manageUser.php");//redirect to another page
	     		
	     	}else if ($_SESSION['usertype']=="moderator") {	
	     		header("location:moderator/addEdit.php");	

	     	}else if ($_SESSION['usertype']=="normal_user") {
	     		header("location:index.php");		

	     	}else{
	     		echo "There is something wrong.";
	     	}
	     	
	     }else{
	     	echo "You do not have the permission to access.";
	     }
     }


 ?>
<body>
	<main>
     <h1>Login</h1>
     <pre>
     <?php 
     	$userType=$_SESSION['usertype'];
     	$username=$_SESSION['username'];

	     if (isset($_SESSION['username'])) {
	     	  echo "<h3>$userType:  $username </h3>";
              echo '<a class="button" href="login/logout.php">Log out</a>';
	   
	     }else{
	         echo '<form method="post" enctype="multipart/form-data">' ;
	         echo "<p>Username</p>";
	         echo "<input name='username' type='text'/> ";
	         echo "<p>Password</p>";
	         echo "<input name='password' type='text'/>";
	         echo "<br/>";
	         echo "<br/>";
             echo "<input name='loginB' type='submit' value='Login'/>";
             echo "</form>";
			        			
	    }
    ?>

    </main>
	
</body>
<?php include("others/footer.php");?> 