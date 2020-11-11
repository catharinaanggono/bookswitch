
	<?php
	
	require_once "../model/common.php";
    
	if (isset($_SESSION["userid"])) { 
        $isbn = $_GET["isbn"];
        $userid = $_SESSION["userid"];
            if(isset($_POST['getCopy'])) { 
                $dao = new listingDAO(); 
                $status = $dao->addCopy($userid,$isbn);
                $_SESSION["button"] = "getCopy"; 
                header("location:bookdetails.php?isbn=$isbn");
                echo "<script>$('#exampleModal').modal('show')</script>";
                
            } else { 
                $dao = new bookmarkDAO(); 
                $status = $dao->addBookmark($userid,$isbn);
                $_SESSION["button"] = "getWishlist"; 
                header("location:bookdetails.php?isbn=$isbn");
                echo "<script>$('#exampleModal').modal('show')</script>";
            }
	} else { 
        header("location:login.html");
    }
?>