<html>
<div class='container'>
    <table border='1' >
     <tr style='background: whitesmoke;'>
      <th>S.no</th>
      <th>Title</th>
      <th>Operation</th>
     </tr>
   
     <?php 
     $query = "SELECT * FROM bookmark";
     $result = mysqli_query($con,$query);
   
     $count = 1;
     while($row = mysqli_fetch_array($result) ){
       $userID = $row['userID'];
       $isbn = $row['isbn'];
   
     ?>
       <tr>
        <td align='center'><?= $userID; ?></td>
        <td align='center'>
          <span class='delete' data-isbn='<?= $isbn; ?>'>Delete</span>
        </td>
       </tr>
     <?php
      $count++;
     }
    ?>
    </table>
   </div>

   <script>
$(document).ready(function(){

// Delete 
$('.delete').click(function(){
  var el = this;
 
  // Delete id
  var deleteid = $(this).data('isbn');

  var confirmalert = confirm("Are you sure?");
  if (confirmalert == true) {
     // AJAX Request
     $.ajax({
       url: 'remove.php',
       type: 'POST',
       data: { isbn:deleteid },
       success: function(response){

         if(response == 1){
     // Remove row from HTML Table
     $(el).closest('tr').css('background','tomato');
     $(el).closest('tr').fadeOut(800,function(){
        $(this).remove();
     });
         }else{
     alert('Invalid isbn.');
         }

       }
     });
  }

});

});


   </script>
</html>
