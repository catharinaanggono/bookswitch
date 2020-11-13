<?php 

    ### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements)
    require_once "../model/common.php";

    class UserDAO { 
 
        public function getUserDetails($userID) {

            $conn_manager = new ConnectionManager(); 
            $pdo = $conn_manager->getConnection(); 

            $sql = "SELECT * FROM person where userID = :userID";
            $stmt = $pdo->prepare($sql); 
            $stmt->bindParam(":userID", $userID,PDO::PARAM_STR); 
            $status = $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        
            $object = "";
            if ($row = $stmt->fetch()) {
                $userid = $row ["userID"];
                $name = $row ["name"];
                $password = $row ["password"];
                $email = $row ["email"];
                $object = new User ($userid,$name,$password,$email);
            }

            $stmt = null; 
            $pdo = null; 

            if ($object == "") {
                return null;
            } else {
                return $object;
            }

        }

        public function checkWishlist($userID,$isbn) {

            $conn_manager = new ConnectionManager(); 
            $pdo = $conn_manager->getConnection(); 

            $sql = "SELECT * FROM wishlist where userID = :userID and isbn = :isbn";
            $stmt = $pdo->prepare($sql); 
            $stmt->bindParam(":userID", $userID,PDO::PARAM_STR); 
            $stmt->bindParam(":isbn", $isbn,PDO::PARAM_STR); 
            $status = $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        
            $check = []; 
            if ($row = $stmt->fetch()) {
                $userid = $row ["userID"];
                $isbn = $row ["isbn"];
                $check[] = $userid; 
                $check[] = $isbn; 
            }

            $stmt = null; 
            $pdo = null; 

            if ($check == []) {
                return False;
            } else {
                return True;
            }

        }

        public function checkListings($userID,$isbn) {

            $conn_manager = new ConnectionManager(); 
            $pdo = $conn_manager->getConnection(); 

            $sql = "SELECT * FROM listings where userID = :userID and isbn = :isbn";
            $stmt = $pdo->prepare($sql); 
            $stmt->bindParam(":userID", $userID,PDO::PARAM_STR); 
            $stmt->bindParam(":isbn", $isbn,PDO::PARAM_STR); 
            $status = $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        
            $check = []; 
            if ($row = $stmt->fetch()) {
                $userid = $row ["userID"];
                $isbn = $row ["isbn"];
                $check[] = $userid; 
                $check[] = $isbn; 
            }

            $stmt = null; 
            $pdo = null; 

            if ($check == []) {
                return False;
            } else {
                return True;
            }

        }

        public function getBookens($userid) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'SELECT bookens FROM person WHERE userID = :userID';
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':userID', $userid, PDO::PARAM_STR);
            $stmt->execute();
            $result = null;
            $bookens = []; 
            if ($row = $stmt->fetch()) {
                $bookens = $row['bookens'];
            }
            $stmt->closeCursor();
            $pdo = null;
            return $bookens;
        }

        public function updateBookens($updatedBookens,$userid) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'UPDATE person set bookens=:bookens WHERE userID=:userID';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userID', $userid, PDO::PARAM_STR);
            $stmt->bindParam(':bookens', $updatedBookens, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            $pdo = null;
        }


    }   

?>