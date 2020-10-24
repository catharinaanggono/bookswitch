<?php 

    ### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements)
    require_once "../model/common.php";

    class listingDAO { 

        public function addCopy($userid, $isbn) { 

            $conn = new ConnectionManager(); 
            $pdo = $conn->getConnection(); 
            $sql = "INSERT INTO listings (userID,isbn) 
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