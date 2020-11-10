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
        
        public function getWishlist($userid) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'SELECT isbn FROM wishlist WHERE userid=:userid';
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
            $stmt->execute();
            $result = null;
            $wishlistRecords = []; 
            while ($row = $stmt->fetch()) {
                $wishlistRecords[] = $row['isbn'];
            }
            $stmt->closeCursor();
            $pdo = null;
            return $wishlistRecords;
        }


    }   

?>
