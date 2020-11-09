
	<?php
	
	### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements), start session, etc
	require_once "../model/common.php";

	### When the form is filled and the login button is clicked
	if (isset($_POST["submit"])) { 

		### Do not need to isset as the fields are required 
		$userid = $_POST["userid"];
		$password = $_POST["password"]; 

		### Retrieve the details of the entered email address
		$dao = new UserDAO(); 
		$object = $dao->getUserDetails($userid);

		### Unable to retrieve any details of the entered email address as email is empty
		if ($object == null) {
			echo "User not found";
			echo "<br>";
			echo "Please try again";
	
		### Entered email address is one of the existing emails in the database  
		} else { 

			### Retrieve the password through the classes & objects (GET Method)  
			$correct_pwd = $object->getPassword();
			// $entered_pwd = password_hash($password, PASSWORD_DEFAULT);

			### Incorrect password  
			if ($password != $correct_pwd) {
				echo "Incorrect password";
				echo "<br>";
				echo "Please try again";
		
			### Correct password. Hence, session stored.  
			} else { 
				// $role = $object->getRole(); 
				// $dao2 = new RoleDAO(); 
				// $role = $dao2->getRole($role);
				// $name = $object->getName();
				// $userid = $object->getUserid();
				$_SESSION["userid"] = $userid;
				// $_SESSION["userid"] = $userid;
				// $_SESSION["name"] = $name;
                header("location:bookdetails.php");
			}
		}

	
	
	}
?>