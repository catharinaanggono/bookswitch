<?php 

    ### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements)
    require_once "../model/common.php";

    class listingDAO { 

        public function addCopy($userid, $isbn, $status) { 
            $conn = new ConnectionManager(); 
            $pdo = $conn->getConnection(); 
            $sql = "INSERT INTO listings (userID,isbn,status) 
            VALUES (:userID, :isbn, :status)";
            $stmt = $pdo->prepare($sql); 
            $stmt->bindParam(':userID', $userid); 
            $stmt->bindParam(':isbn', $isbn); 
            $stmt->bindParam(':status', $status);
            $return = $stmt->execute(); 
            $stmt->closeCursor(); 
            $pdo = null; 
            return $return;
        }

        public function getListing($userid) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'SELECT * FROM listings WHERE userid=:userid';
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
            
            $stmt->execute();
            $result = null;
            $listingsRecords = []; 
            while ($row = $stmt->fetch()) {
                $listingsRecords[] = [$row['isbn'], $row['status']];
            }
            $stmt->closeCursor();
            $pdo = null;
            return $listingsRecords;
        }


    }   

?>
