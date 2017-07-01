<html>
<h4>REGISTERED SUCCESSFULLY!</h4>
<?php
if(isset($_POST['submit'])) {
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'password');
   define('DB_DATABASE', 'Delta_Task_3');
   $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE, 9000);
   
   if(  $conn->connect_error ) {
           die('Could not connect: ' . $conn->connect_error);
   }
   
   $uid = mysqli_real_esacpe_string($conn, $_POST['uid']);
   $pwd = mysqli_real_esacpe_string($conn, $_POST['pwd']);
   $full = mysqli_real_esacpe_string($conn, $_POST['full']);
   $email = mysqli_real_esacpe_string($conn, $_POST['email']);
   
   // hashing the password 
   $hashedpwd = sha1($pwd);

   $val = $conn->query($sql);
   if($val == FALSE){
	    $sql = 'CREATE TABLE userTable( '.
      		   'id INT NOT NULL AUTO_INCREMENT, '.
      		   'userName VARCHAR(10) NOT NULL, '.
      		   'password  VARCHAR(50) NOT NULL, '.
      		   'full_name VARCHAR(100) NOT NULL, '.
		   'email VARCHAR(50) NOT NULL, '.
		   'primary key ( id ));';
  	
   	   $retval = $conn->query($sql);
   
   	   if( $retval ) {
      		   echo "Created table!";
	   }
   }

   $sql = "INSERT INTO userTable ". "(userName,password, full_name, 
           email) ". "VALUES('$uid','$hashedpwd','$full', '$email')";
				

   $retval = $conn->query($sql);
            
 if(! $retval ) {
 die('Could not enter data: ' . $conn->error);
            }
            
    
 $conn->close();
			
   }
?>
</html>
