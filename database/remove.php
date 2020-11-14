<?php 
include "config.php";

$isbn = 0;
if(isset($_POST['isbn'])){
   $isbn = mysqli_real_escape_string($con,$_POST['isbn']);
}
if($isbn > 0){

  // Check record exists
  $checkRecord = mysqli_query($con,"SELECT * FROM listings WHERE isbn=".$isbn);
  $totalrows = mysqli_num_rows($checkRecord);

  if($totalrows > 0){
    // Delete record
    $query = "DELETE FROM listings WHERE isbn=".$isbn;
    mysqli_query($con,$query);
    echo 1;
    exit;
  }else{
    echo 0;
    exit;
  }
}

echo 0;
exit;

?>