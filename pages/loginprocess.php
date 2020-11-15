<?php
	
	### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements), start session, etc
 	require_once "../model/common.php";


	### When the form is filled and the login button is clicked
	if (isset($_POST["submit"])) { 

		### Do not need to isset as the fields are required 
		$userid = $_POST["userid"];
		$password = $_POST["password"];
		// if (isset($_POST["page_dest"])){
		// 	$page_dest = $_POST["page_dest"];
		// }


		### Retrieve the details of the entered email address
		$dao = new UserDAO(); 
		$object = $dao->getUserDetails($userid);

		### Unable to retrieve any details of the entered email address as email is empty
		if ($object == null) {
			$_SESSION["error"] = "User not found";
			header("location:login.php?e=unf");
			
	
		### Entered email address is one of the existing emails in the database  
		} else { 

			### Retrieve the password through the classes & objects (GET Method)  
			$correct_pwd = $object->getPassword();
			// $entered_pwd = password_hash($password, PASSWORD_DEFAULT);

			### Incorrect password  
			if ($password != $correct_pwd) {
				$_SESSION["error"] = "Incorrect password";
				header("location:login.php?e=ip");
			### Correct password. Hence, session stored.  
			} else {

				$_SESSION["userid"] = $userid;
				unset($_SESSION["error"]);

				
				$bookens = $dao->getBookens($userid);
				if (isset($bookens)) { 
					$_SESSION["bookens"] = $bookens;

				}
				if (isset($_SESSION["redirect_to"])) { 
					$page_dest = $_SESSION["redirect_to"];
				}

				if (isset($_SESSION["isbn"])) { 
					$isbn = $_SESSION["isbn"];
					header("location:bookdetails.php?isbn=$isbn");
				}
				elseif(isset($_SESSION["query"]) and isset($_SESSION["category"])){
					$query = $_SESSION["query"];
					$category = $_SESSION["category"];
					header("location:$page_dest?query=$query&category=$category");
				}
				else {
					header("location:$page_dest");
				}

				
				
			}
		}

	
	
	}
?>