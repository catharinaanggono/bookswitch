
	<?php
	
	require_once "../model/common.php";
    
	if (isset($_SESSION["userid"])) { 
        $isbn = $_GET["isbn"];
        $userid = $_SESSION["userid"];
            if(isset($_POST['getCopy'])) { 
                $dao = new listingDAO(); 
                $nStatus = "NO";
                $deleteStatus = $dao->deleteCopy($isbn,$nStatus);
                $status = "YES";
                $status = $dao->addCopy($userid,$isbn,$status);
                if ($status == true) {
                    $_SESSION["button"] = "getCopy"; 
                }
                header("location:bookdetails.php?isbn=$isbn");
                echo "<script>$('#exampleModal').modal('show')</script>";
                
            } else { 
                $dao = new bookmarkDAO(); 
                $checkBookmark = $dao->checkBookmark($userid,$isbn);

                if ($checkBookmark == []) {
                    $status = $dao->addBookmark($userid,$isbn);
                    $_SESSION["bookmark"] = "redBk";
                } else { 
                    $status = $dao->deleteBookmark($userid,$isbn);
                }
    
                $_SESSION["button"] = "getBookmark";
                header("location:bookdetails.php?isbn=$isbn");
                echo "<script>$('#exampleModal').modal('show')</script>";
            }
	} else { 
        $_SESSION["isbn"] = $_GET["isbn"];
        header("location:login.html");

    }
?>