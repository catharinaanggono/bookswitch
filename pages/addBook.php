
	<?php
	
	require_once "../model/common.php";
    
	if (isset($_SESSION["userid"])) { 
        $isbn = $_GET["isbn"];
        $userid = $_SESSION["userid"];
            if(isset($_POST['getCopy'])) { 
                $dao = new listingDAO(); 
                $status = $dao->addCopy($userid,$isbn);
                // bring to which webpage next? 
                // header("location:login.html");
                
            } else { 
                $dao = new wishlistDAO(); 
                $status = $dao->addWishlist($userid,$isbn);
                // bring to which webpage next? 
                // header("location:login.html");
            }
	} else { 
        header("location:login.html");
    }
?>