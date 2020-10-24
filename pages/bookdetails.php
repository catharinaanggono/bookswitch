<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Book Details</title>

    <!-- Vue.js CDN -->
    <script src="./bookdetails.js"></script>

    <style>

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
            color: hotpink;
        }

        button {
            color: #5d7db8;
        }

        #more {display: none;}

    </style>

</head>
<?php 
	require_once "../model/common.php";
?>
<body onload="display_default()" style="background-color:whitesmoke;">

    <!-- Should retrieve the isbn of the book and retrieve the details from the api-->
    <!-- e.g. fix one isbn for time being, veron's page is supposed to provide the isbn of the book -->
    <!-- trish page is supposed to have the api as it helps to retrieve the books -->
    <!-- isbn example used = 88KiDgAAQBAJ -->

    <!-- Navbar -->
     
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
                          <h5 class="card-title" id = "bookTitle">Percy Jackson & the Olympians: The Lightning Thief</h5>
                          <p class="card-text" style = "padding-top: 5px;"> 
                            <span id = "author"></span> <br>
                            <span id = "published_date"></span> <br>
                            Rating:
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                          </p>
                          <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class ="card-group">
                    <div class="card-transparent">
                        <div class="card-body">
                          <h5 class="card-title">Book Description</h5>
                          <p id = "bk_description" class="card-text">
                        </p>
                        </div>
                      </div>
                </div>
                <hr>

                <?php
                    $isbn = 9781760553128;
                    if (isset($_SESSION["userid"])) { 
                        $userid = $_SESSION["userid"]; 
                    }else { 
                        $userid = null; 
                    }
                    $isbn = 9781760553128;
                    $dao = new userDAO(); 
                    $checkWishlist = $dao->checkWishlist($userid,$isbn);
                    $checkListings = $dao->checkListings($userid,$isbn);

                    if ($checkWishlist == False && $checkListings == False ) {
                        echo "    <form method='POST' action= 'addBook.php?isbn=9781760553128'> 
                        <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn btn-outline-primary'>
                        <input type='submit' name = 'addWishlist' value = 'Add to Wishlist' 
                        class='btn btn-outline-primary'>
                    </form>";
                    } else if ($checkWishlist == False && $checkListings == True ) {
                        echo "    <form method='POST' action= 'addBook.php?isbn=9781760553128'> 
                        <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn btn-outline-primary' disabled>
                        <input type='submit' name = 'addWishlist' value = 'Add to Wishlist' 
                        class='btn btn-outline-primary'>
                    </form>";
                    } else if ($checkWishlist == True && $checkListings == False) {
                        echo "    <form method='POST' action= 'addBook.php?isbn=9781760553128'> 
                        <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn btn-outline-primary' >
                        <input type='submit' name = 'addWishlist' value = 'Add to Wishlist' 
                        class='btn btn-outline-primary' disabled>
                    </form>"; 
                    } else { 
                        echo "    <form method='POST' action= 'addBook.php?isbn=9781760553128'> 
                        <input type='submit' name = 'getCopy' value ='Get a Copy' class='btn btn-outline-primary' disabled>
                        <input type='submit' name = 'addWishlist' value = 'Add to Wishlist' 
                        class='btn btn-outline-primary' disabled>
                    </form>"; 
                    }
                ?>

            
            </div>
         
          </div>
    </div>
    
    <script>
        function myFunction() {
          var dots = document.getElementById("dots");
          var moreText = document.getElementById("more");
          var btnText = document.getElementById("myBtn");
        
          if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more"; 
            moreText.style.display = "none";
          } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less"; 
            moreText.style.display = "inline";
          }
        }
    </script>

</body>

<footer>

</footer>

</html>