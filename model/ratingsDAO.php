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
            }

            for ($i=0;$i<count($listingsRecords);$i++) {
                echo($listingsRecords[i]);
            }
            $avgRate = "Nothing";
            $stmt->closeCursor();
            $pdo = null;
            if ($listingsRecords != []) {
                echo("okay");
                $avgRate = round($totalRatings/$numberPeople);
                echo($totalRatings);
                echo($numberPeople);
                return $avgRate;
            }
            
        }

    }   

?>
