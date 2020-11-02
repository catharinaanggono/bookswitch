<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Book Details</title>


    <title>BookSwitch</title>
    

    <style>
      
      #wishlist_tab, #listings_tab {
        color: #ffffff;
      }
      #wishlist_tab.active, #listings_tab.active {
        color: black;
      }
      #mybooksHeader {
        background-color: black;
        color: white;
        padding-top: 100px;
        padding-bottom: 0px;
        padding-left: 6%;

      }
      #all_tab, #reserved_tab, #exchange_tab {
        color: #5D7DB8;
      }
      #all_tab.active, #reserved_tab.active, #exchange_tab.active {
        color: black;
      }

      .tab-content {
        padding-left: 6%;
      }
      
      
      /*js stuff */
      #personal {
        position: relative;
        width: 20%;
      }
      .image {
        opacity: 1;
        display: block;
        width: 10%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
      }
      .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 25%;
        /* left: 5%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-5%, -5%); */
        text-align: center;
      }
      #personal:hover .image {
        opacity: 0.3;
      }
      #personal:hover .middle {
        opacity: 1;
      }
      .text {
        background-color: white;
        color: black;
        font-size: 10px;
        padding: 8px 16px;
      }
    </style>

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
      <!-- Google fonts-->
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
      <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
      <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="../css/homepage.css" rel="stylesheet" />

    
  </head>

  <?php 
    require_once "../model/common.php";
  ?>
  
  <!-- <body onload="getWishlist()"> -->
  <body onload="get_wishlist()">
    <!--Jess's Navbar here-->

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="homepage.html"><img src="../images/bookswitch_logo.svg" alt="" /></a>
                <div class="d-flex flex-row order-2 order-lg-3">

                    <ul class = "navbar-nav">
                        <li class="nav-item nav-link" id="bookens"><span style="color: white;">50</span><img src="../images/bookens.svg" width="22" height="22"></a></li>
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
                            <div class="search">
                                <input id="autocomplete" type="text" placeholder="Search Title, Author, ISBN">
                            </div></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio"><i class="far fa-user"></i>user1</a></li>
                        
                    </ul>
                </div>
                
                        
            </div>
            
        </nav>
    <!---->

    
    <div class="jumbotron jumbotron-fluid" id="mybooksHeader">
        <h1 class="display-4" style="margin-bottom: 50px;">My Books</h1>
        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" style="padding-right: 6%;">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="wishlist_tab" data-toggle="tab" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="true" onclick="get_wishlist()">Wishlist</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="listings_tab" data-toggle="tab" href="#listings" role="tab" aria-controls="listings" aria-selected="false" onclick="getListings('ALL')">My Listings</a>
        </li>
      </ul>
      
    </div>

    <!-- php stuff -->
    <?php

            $_SESSION["userid"] = "aytt";
            if (isset($_SESSION["userid"])) {
              $userid = $_SESSION["userid"];

              // listings
              $dao = new WishlistDAO();
              $wishlist = $dao->getWishlist($userid);
              $_SESSION["wishlist"] = $wishlist;
              $dao2 = new ListingDAO();
              $listing = $dao2->getListing($userid);
              $_SESSION["listing"] = $listing;
              
            } else { 
              //header("Location: login.html");
            }


          ?>
    <!--Navbar for wishlist and my listings-->
    
      <!--Navbar contents-->
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
            
            <!-- Wishlist stuff here -->
           
            <div id="wishlist_cards"></div>
              
        
        </div>
        <div class="tab-pane fade" id="listings" role="tabpanel" aria-labelledby="listings-tab">
            
            <!-- My listings stuff here -->

            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" id="all_tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true" onclick="getListings('ALL')">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="reserved_tab" data-toggle="tab" href="#reserved" role="tab" aria-controls="reserved" aria-selected="true" onclick="getListings('YES')">Reserved for Exchange</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="exchange_tab" data-toggle="tab" href="#notreserved" role="tab" aria-controls="notreserved" aria-selected="true" onclick="getListings('NO')">Not Reserved</a>
              </li>
            </ul>
            <div id="myListings_cards"></div>
            
        </div>
      </div>
    

<script> 
  

  function get_wishlist() {
    document.getElementById('wishlist_cards').innerHTML = '';
    var wishlist = <?php echo json_encode($wishlist); ?>;

    for (var isbn of wishlist) {

      get_wishlist_book(isbn);
    }

  };

function getListings(status) {
  document.getElementById("myListings_cards").innerHTML = '';
  var listing = <?php echo json_encode($listing); ?>;


  if (status == 'ALL') {
    for (var book of listing) {
      var isbn = book[0];
      get_listings_book(isbn);
    };
  } else {
    
    for (var book of listing) {
      var isbn = book[0];
      var reserve = book[1];
      if (reserve == status) {
        get_listings_book(isbn);
      }
    }
  }
  
};



function get_wishlist_book(isbn) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var json_obj = JSON.parse(request.responseText);
            var items = json_obj.items;
            var html_text = '';

            for (item of items) {
                var image = item.volumeInfo.imageLinks.thumbnail;
                var title = item.volumeInfo.title;
                var desc = item.volumeInfo.description;
                //var updated = ; // put time updqated 

                html_text += `
                <div class="container d-inline-block" id="personal">
                  <img src="${image}" alt="bookimage" class="image" style="width:100%">
                  <div class="middle">
                    <div class="text"><b>${title}</b><br>${desc}</div>
                  </div>
                </div>
                `;

                

            }

            document.getElementById('wishlist_cards').innerHTML += html_text;


    }
}

    // var key = 'AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE';
    // var userid = '105224440927779280831';
    // var wishlist_shelf = '1001';
    var url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`;

    
    request.open("GET", url, true);

    request.send();

  
};

function get_listings_book(isbn) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var json_obj = JSON.parse(request.responseText);
            var items = json_obj.items;

            var html_text = "";

            for (item of items) {// incomplete, based on db
                var image = item.volumeInfo.imageLinks.thumbnail;
                var title = item.volumeInfo.title;
                var desc = item.volumeInfo.description;
                //var updated = ; // put time updqated 

                html_text += `
                <div class="container d-inline-block" id="personal">
                  <img src="${image}" alt="bookimage" class="image" style="width:100%">
                  <div class="middle">
                    <div class="text"><b>${title}</b><br>${desc}</div>
                  </div>
                </div>
                `;

            }

            document.getElementById("myListings_cards").innerHTML += html_text;


    }
    }

    // var userid = '105224440927779280831';
    // var listings_shelf = '1002';
    var url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`;

    request.open("GET", url, true);

    request.send();



}


  



</script>

    <!-- <script src="mybooks.js"></script>  -->



    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->
    <!-- Core theme JS-->
    <script src="../js/homepage.js"></script>
    

  </body>
</html>