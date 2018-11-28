<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tingmo Liu (Yimo)</title>
      <link rel="stylesheet" type="text/css" href="../main.css">

</head>
<body>
  <main>
     <h1>Upload new project</h1>
	    <form action="upload.php" method="post" enctype="multipart/form-data">
            <div>
        		   <p>Date</p>
      	   	   <input name="dateU" type="text"/>
        		</div>
        		<div>
        		   <p>Design Name</p>
      	   	   <input name="nameU" type="text"/>
        		</div>
            <div>
            	   <p>The type</p>
      	   	     <select name="typeU">
                    <option value="1">Graphic design assignment</option>
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
      	   	   <input name="commentU" type="text"/>
            </div>
            <div>
                 <p>Select Pictures</p>
                 <input name="uploadPic" type="file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg"/>  
                 <br/>
                 <br/>
      	   	   <input name="uploadButton" type="submit" value="Upload"/>
      	</form>  
  </main>
  
  
</body>
</html>

