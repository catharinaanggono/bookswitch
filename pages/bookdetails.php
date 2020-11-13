<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <!-- jQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Bootstrap CSS --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     -->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <title>Book Details</title>
    <link href="../css/homepage.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap" rel="stylesheet">
    <script src='./bookdetails.js'></script>



    <style>
        #bookTitle.dark{
            color:#B5C587;
        }   

        .headerNames.dark{
            color:#B5C587;
        }   

        h5.dark{
            color:#B5C587;
        }   

        #published_date.dark{
            color:#D5D3BF ;
        }   

        #bk_description.dark{
            color:#D5D3BF;
        }   

        #author.dark{
            color:#D5D3BF;
        }   

        .cm-btn{
            border:none;
            background:#405080;
            color:white;
            border-radius:2px;
        }   

        .card {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px; 
            margin-top:15px;
        }

        .card-img-top {
            margin-top:10px;
            max-width: 50%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .container-fluid {
            margin-top:15px;
        }

        .card-title {
            padding: 15px;
        }

        .card-text {
            padding: 15px;
        }

        .checked {
            color: #B5C587;
        }

        button {
            color: #0D3D54;
        }

        #more {
            display: none;
        }

        .black-background {
            background-color:#0D3D54;
        }

        .white {
            color:#ffffff;
        }

        .modal-content {
            background-color:#B5C587;
        }

        .red {
            color:red;
        }
/* 
        body {
            font-family: 'Cormorant Garamond', serif;
        }
         */
        button,input {
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, 
            "Helvetica Neue", Arial, sans-serif, 
            "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>

    <?php 

            if (isset($_GET["isbn"])) {
                $isbn = $_GET["isbn"]; 
                $_SESSION["isbn"] = $isbn; 
            }

    ?>

</head>

<?php 
	require_once "../model/common.php";
?>

<body onload="display_default('<?php echo $_GET['isbn']; ?>')" >
    
     <!-- Navigation-->
     <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="../images/bookswitch.svg" alt="" /></a>
                <div class="d-flex flex-row order-2 order-lg-3">

                    <ul class = "navbar-nav">
                        <li class="nav-item nav-link" id="bookens"><span style="color:#474E45;">50</span><img src="../images/bookens_circle.svg" width="17" height="17"></a></li>
                                                
                    </ul>

                    <button class="navbar-toggler navbar-toggler-right ml-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <!-- Menu -->
                        <i class="fas fa-bars ml-1"></i>
                    </button>
                </div>
                
                <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Genre</a></li>
                        <li class="nav-item">
                            <div class="search" id="search">
                                <input id="autocomplete" type="text" placeholder="Search Title, Author, ISBN">
                            </div></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio"><i class="far fa-user"></i>user1</a></li>
                        
                    </ul>
                </div>
                
                <div>
                  <input type="checkbox" class="checkbox" id="chk" />
                  <label class="label" for="chk">
                    <i class="fas fa-moon"></i>
                    <i class="fas fa-sun"></i>
                    <div class="ball"></div>
                  </label>
                </div>        
            </div>
            
        </nav>
    
    <!-- Modal -->
    <br><br><br><br>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php
                if ($_SESSION["button"] == "getCopy") { 
                    echo " Your selection has been personally added into your listings. <br> 
                    Please proceed to your profile to view your listings.";
                }
                
                if (isset($_SESSION["bookmark"])) { 
                    echo " Your selection has been bookmarked. <br> 
                    Please proceed to your profile to view your bookmarks.";
                } else {
                    echo " Your selection has removed from your bookmarks."; 
                }

            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn black-background white" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    

    </div>

    <div class = "container-fluid">
        <div class="row">
            
            <div class="col-sm-2">
            </div>
            <div class="col-md-3">
                <div class ="card-group">
                    <div class="card-transparent" style="width: 18rem;">
                        <!-- Book Image -->
                        <img id = "BkImg" class="card-img-top justify-content-center" src="???" alt="Card image cap">
                        <div class="card-body">
                          <!-- Book Title -->
                          <h5 class="card-title bookDetails" style = "font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 
                            'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; font-size: 27px;"  id = "bookTitle"></h5>
                          <p class="card-text" style = "padding-top: 5px;"> 
                            <span class='headerNames'><b>Author: </b> </span><span id = "author" class = "bookDetails" style = "font-size: 15px;"></span> <br>
                            <span class='headerNames'><b>Published Date:</b> </span><span id = "published_date" class = "bookDetails" style = "font-size: 15px;"></span> <br>
                            <span style = "font-size: 15px;"></span>
                            <!-- Ratings --> 
                            <?php
                                $dao3 = new ratingsDAO(); 
                                $getRatings = $dao3->getRatings($isbn);

                                for ($i=0;$i<$getRatings;$i++) {
                                    echo "<span class='fa fa-star checked'></span>";
                                } 

                                $noStars = 5 - $getRatings; 
                                if ($noStars > 0) {
                                    echo "<span class='fa fa-star'></span>";
                                }
                            ?>
                          </p>
                          <!-- <a href="#" class="btn btn-outline-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class ="card-group">
                    <div class="card-transparent">
                        <div class="card-body" >
                          <h5 class="card-title bookDetails" style = "font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 
                            'Helvetica Neue', Arial, sans-serif, 
                            'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; font-size: 27px;">Book Description</h5>
                          <p id = "bk_description" class="card-text bookDetails">
                        </p>
                        </div>
                      </div>
                </div>
                <hr>    

                    
    <!-- Button trigger modal -->
    <script>

    var $chosenBtn = "<?php echo isset($_SESSION["button"]); ?>";

        if ($chosenBtn == true) {
            $(document).ready(function(){ 
            $('#exampleModal').modal('show');
            })
        }

    var $bookmark = "<?php echo isset($_SESSION["bookmark"]); ?>";

    if ($chosenBtn == true) {
        $(document).ready(function(){ 
        $('#exampleModal').modal('show');
        })
    }


    </script>

    <?php 
        if (isset($_SESSION['button'])) {
            unset($_SESSION['button']);
        }

        if (isset($_SESSION['bookmark'])) {
            unset($_SESSION['bookmark']);
        }
    ?>

    <?php
        
        if (isset($_SESSION["userid"])) { 
            $userid = $_SESSION["userid"]; 
        }else { 
            $userid = null; 
        }

        ### Check the quantity in listings that are not reserved
        $dao = new listingDAO(); 
        $checkAvailQty = $dao->checkAvailQty($isbn);
        $dao1 = new BookmarkDAO(); 
        $checkBookmark = $dao1->checkBookmark($userid,$isbn);
        
        echo "    <form method='POST' action= 'addBook.php?isbn=$isbn'> ";

        if ($checkBookmark == []) {
            echo "   <button type='submit'  name = 'bookmark' class='btn black-background white'>
            <i class='far fa-bookmark'></i>
            </button>";
            
        } else { 
            echo "   <button name='bk' type='submit' value='bk' class ='btn black-background white' >
            <i class='far fa-bookmark red'></i></button>";
        }

        if ($checkAvailQty == []) {
            echo "    
            <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn black-background white' disabled>";
        } else { 
            echo "    
            <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn black-background white'>";
        }


        
        
        echo "</form>";

        // $dao = new userDAO(); 
        // $checkWishlist = $dao->checkWishlist($userid,$isbn);
        // $checkListings = $dao->checkListings($userid,$isbn);

        // if ($checkWishlist == False && $checkListings == False ) {
        //     echo "    <form method='POST' action= 'addBook.php?isbn=$isbn'> 
        //     <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn black-background white' >
        //     <input type='submit' name = 'addWishlist' value = 'Add to Bookmark' 
        //     class='btn black-background white'>
        // </form>";
        // } else if ($checkWishlist == False && $checkListings == True ) {
        //     echo "    <form method='POST' action= 'addBook.php?isbn=$isbn'> 
        //     <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn black-background white' disabled>
        //     <input type='submit' name = 'addWishlist' value = 'Add to Bookmark' 
        //     class='btn black-background white'>
        // </form>";
        // } else if ($checkWishlist == True && $checkListings == False) {
        //     echo "    <form method='POST' action= 'addBook.php?isbn=$isbn'> 
        //     <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn black-background white' >
        //     <input type='submit' name = 'addWishlist' value = 'Add to Bookmark' 
        //     class='btn black-background white' disabled>
        // </form>"; 
        // } else { 
        //     echo "    <form method='POST' action= 'addBook.php?isbn=$isbn'> 
        //     <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn black-background white' disabled>
        //     <input type='submit' name = 'addWishlist' value = 'Add to Bookmark' 
        //     class='btn black-background white' disabled>
        // </form>"; 
        // }
    ?>

            
            </div>
         
          </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- BookSwitch JS -->
    <script src='../js/homepage.js'></script>
    <script src='../js/book_search.js'></script>


</body>

<footer>

</footer>

</html>