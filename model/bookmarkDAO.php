<?php 

    ### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements)
    require_once "../model/common.php";

    class bookmarkDAO { 

        public function addBookmark($userid, $isbn) { 

            $conn = new ConnectionManager(); 
            $pdo = $conn->getConnection(); 
            $sql = "INSERT INTO bookmark(userID,isbn) 
            VALUES (:userID, :isbn)";
            $stmt = $pdo->prepare($sql); 
            $stmt->bindParam(':userID', $userid); 
            $stmt->bindParam(':isbn', $isbn); 
            $status = $stmt->execute(); 
            $stmt->closeCursor(); 
            $pdo = null; 
            return $status;

        }
        
        public function getBookmark($userid) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'SELECT isbn FROM bookmark WHERE userid=:userid';
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

        public function checkBookmark($userid,$isbn) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'SELECT * FROM bookmark WHERE userid=:userid and isbn=:isbn';
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $stmt->execute();
            $result = null;
            $bookmark = []; 
            if ($row = $stmt->fetch()) {
                $bookmark[] = $row['isbn'];
            }
            $stmt->closeCursor();
            $pdo = null;
            return $bookmark;
        }

        public function deleteBookmark($userid,$isbn) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'DELETE FROM bookmark WHERE userid=:userid and isbn=:isbn';
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $stmt->execute();
        
            $stmt->closeCursor();
            $pdo = null; 
        }


    }   

?>
