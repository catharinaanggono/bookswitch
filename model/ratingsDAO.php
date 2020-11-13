<?php 

    ### Connecting to the file which consists codes to connect to the database (Essential for PDOStatements)
    require_once "../model/common.php";

    class ratingsDAO { 

        public function getRatings($isbn) {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = 'SELECT * FROM ratings WHERE isbn=:isbn';
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $stmt->execute();
            $result = null;
            $listingsRecords = []; 
            if ($row = $stmt->fetch()) {
                $totalRatings = $row['totalRate'];
                $numberPeople = $row['noPpl'];
                $listingsRecords[] = $totalRatings;
                $listingsRecords[] = $numberPeople;
            }

            $avgRate = "Nothing";
            $stmt->closeCursor();
            $pdo = null;
            if ($listingsRecords != []) {
                $avgRate = floor($totalRatings/$numberPeople);
            }

            return $avgRate;
            
        }

    }   

?>
