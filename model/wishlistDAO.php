<?php 

    ### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements)
    require_once "../model/common.php";

    class wishlistDAO { 

        public function addWishlist($userid, $isbn) { 

            $conn = new ConnectionManager(); 
            $pdo = $conn->getConnection(); 
            $sql = "INSERT INTO wishlist (userID,isbn) 
            VALUES (:userID, :isbn)";
            $stmt = $pdo->prepare($sql); 
            $stmt->bindParam(':userID', $userid); 
            $stmt->bindParam(':isbn', $isbn); 
            $status = $stmt->execute(); 
            $stmt->closeCursor(); 
            $pdo = null; 
            return $status;

        }
  


    }   

?>