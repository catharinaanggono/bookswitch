<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
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

    <link href="../css/homepage.css" rel="stylesheet" />
    <link href="../css/bookswitch.css" rel="stylesheet" />
    <link href="../css/book_genre.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <title>My Books</title>


    <title>BookSwitch</title>
    

    <style>
      body {
        padding-top: 0px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
      }
          /* Rounded tabs */

        @media (min-width: 576px) {
          .rounded-nav {
            border-radius: 50rem !important;
          }
        }

        @media (min-width: 576px) {
          .rounded-nav .nav-link {
            border-radius: 50rem !important;
          }
        }
      
      #wishlist_tab, #listings_tab {
        color: #ffffff;
      }

      #wishlist_tab.active, #listings_tab.active {
        background-color: #474E45;
      }

      #mybooksHeader {
        background-color: #B5C587;
        color: #474E45;
        /* padding-top: 100px; */
        padding-bottom: 0px;
        padding-left: 5%;

      }
      #all_tab, #reserved_tab, #exchange_tab {
        color: #474E45;
      }
      /* colour of tabs when dark mode is on */
      #all_tab.dark, #reserved_tab.dark, #exchange_tab.dark {
        color: #D5D3BF;
      }

      #all_tab.active, #reserved_tab.active, #exchange_tab.active {
        color: #474E45;
      }

      .tab-content {
        padding-left: 5%;
        padding-right: 5%;
      }

      #myTab {
        background-color: #a1ab85;
      }

      .mybooks {
        background-color: #d4dde0;
        padding: 20px;
        height: 325px;
        width: 300px;

      }

      #bookstuff {
        height: 250px;
        display: block;
      }


      footer{
          background-color: #6b7269;
          color: white;
      }

      footer a{
          color: #B5C587;
      }

      footer a:hover{
          color: #B5C587;
          /* color: #267055; */
      }
      
    </style>

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>


    
  </head>

  <?php 
    require_once "../model/common.php";
  ?>
  
  <!-- <body onload="getBookmark()"> -->
  <body onload="get_Bookmark()">
    <!--Jess's Navbar here-->
    <!-- Navigation-->
    <?php if (isset($_SESSION['userid']) or !empty($_SESSION['userid'])) { // or however you determine they're logged in ?>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="homepage.php"><img src="../images/bookswitch.svg" alt="" /></a>
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
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../pages/book_genre.html">Genre</a></li>

                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../pages/mybooks.php"><i class="far fa-user"></i><?php echo $_SESSION['userid'];?></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../pages/logout.php">Logout</a></li>

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
          
        <?php } else { ?>
          <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="homepage.html"><img src="../images/bookswitch.svg" alt="" /></a>
                <div class="d-flex flex-row order-2 order-lg-3">

                    <!-- <ul class = "navbar-nav">
                        <li class="nav-item nav-link" id="bookens"><span style="color:#474E45;">50</span><img src="../images/bookens_circle.svg" width="17" height="17"></a></li>
                    </ul> -->

                    <button class="navbar-toggler navbar-toggler-right ml-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <!-- Menu -->
                        <i class="fas fa-bars ml-1"></i>
                    </button>
                </div>
                
                <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="book_genre.html">Genre</a></li>
                          <!-- <div class="search" id="search">
                            <input id="autocomplete" type="text" placeholder="Search Title, Author, ISBN" onkeypress="javascript:doit_onkeypress(event);">
                          </div></li> -->
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login.php?redirect_to=homepage.php"><i class="far fa-user"></i>Login</a></li>
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
          <?php } ?>
    <!---->

    
    <div class="jumbotron jumbotron-fluid" id="mybooksHeader" style="padding-left: 5%; padding-right: 5%;">
    <div class="row">
      <h1 class="display-4 col-4" style="margin-bottom: 50px; margin-top:50px;">My Books</h1>
      <div class="col-8" style="display:flex; justify-content: center; align-items: center;">
        <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills text-center border-0 rounded-nav" style="width: 70%;">
              <li class="nav-item " style="width: 50%">
                <a data-toggle="tab" id="wishlist_tab" href="#wishlist" role="tab" aria-controls="home" aria-selected="true" onclick="get_Bookmark()" onclick="openLink(event, 'Left')" class="nav-link border-0 text-uppercase font-weight-bold active" style="margin-bottom:0px;"><img src="../images/bookmarks_nobg.png" width="50%" height="auto"></a>
              </li>
              <li class="nav-item" style="width: 50%">
                <a data-toggle="tab" id="listings_tab" href="#listings" role="tab" aria-controls="profile" onclick="getListings('ALL')" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold"><img src="../images/listings_nobg.png" width="50%" height="auto"></a>
              </li>
        </ul>

      </div>
    </div>
        
      
    </div>
    

    <!-- php stuff -->
    <?php


      if (isset($_SESSION["userid"])) { 
        $userid = $_SESSION["userid"]; 
      }else { 
        $userid = null; 
      }
      


      // listings
      $dao = new bookmarkDAO();
      $dao2 = new listingDAO();
      if (isset($_POST['deletebookmark'])) {
        $isbn = $_POST['deletebookmark'];
        $dao->deleteBookmark($userid,$isbn);
        unset($_POST['deletebookmark']);

      }
      if (isset($_POST['deletelisting'])) {
        $isbn = $_POST['deletelisting'];
        $dao2->deleteCopy($isbn);
        unset($_POST['deletelisting']);
      }

      $bookmark = $dao->getBookmark($userid);
      $_SESSION["bookmark"] = $bookmark;
      // $delete = $dao->deleteBookmark($userid,$isbn);
      
      $listing = $dao2->getListing($userid);
      $_SESSION["listing"] = $listing;
      
      
      
      
    


          ?>
    <!--Navbar for Bookmarks and my listings-->
    
      <!--Navbar contents-->
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
            
            <!-- Bookmark stuff here -->

              <div id="wishlist_cards" class="row"></div>

        
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


              <div id="myListings_cards" class="row"></div>

            
            
        </div>
      </div>





<!-- FOOTER -->
    <footer class="page-footer font-small blue px-4 py-5">
    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
      <!-- Grid row -->
      <div class="row">
        <!-- First column -->
        <div class="col-md-6 mb-md-0 mb-3">
          <!-- Links -->
          <h5 class="text-uppercase">Support</h5>
          <ul class="list-unstyled">
            <li>
              <a href="#">Contact Us</a>
            </li>
            <li>
              <a href="#">FAQ</a>
            </li>
            <li>
              <a href="#">About Us</a>
            </li>
          </ul>
        </div>

        <!-- Second column -->
        <div class="col-md-6 mt-md-0 mt-3">
          <div class='container'>
            <!-- Content -->
            <img src='../images/bookswitch_footer.svg' style='width: 200px; height: 80px;'>
          </div>

          <div class='container pl-4'>
            <i class="fab fa-facebook-square" style="font-size:24px"> </i>
            <i class="fab fa-twitter-square" style="font-size:24px"> </i>
            <i class="fab fa-google-plus-square" style="font-size:24px"> </i>
            <i class="fab fa-instagram-square" style="font-size:24px"> </i>
            <i class="fas fa-envelope-square" style="font-size:24px"> </i>    
          </div>        
        </div>
        <!-- <hr class="clearfix w-100 d-md-none pb-3"> -->
      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright - BookSwitch
    </div>
    <!-- Copyright -->

    </footer>
    <!-- Footer -->
    
<!-- JAVASCRIPT PART -->
<script>
  
  function redirect(isbn) {
      location.href = `bookdetails.php?isbn=${isbn}`;
      console.log(index);
      document.getElementById('title').getElementsByTagName('a')[0].setAttribute('href', `bookdetails.php?isbn=${isbn}`);
  }

  function show_desc(id) {
      var node = document.getElementById(id);
      node.setAttribute('style', 'visibility: visible;');
  }

  function hide_desc(id) {
      var node = document.getElementById(id);
      node.setAttribute('style', 'visibility: hidden;');
  }

  // tab functions

  var index = 0;
  var x = 0;
  function get_Bookmark() {
    document.getElementById('wishlist_cards').innerHTML = '';
    var bookmark = <?php echo json_encode($bookmark); ?>;

    for (var isbn of bookmark) {

      get_bookmark_book(isbn);
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

  // calling API

  function get_bookmark_book(isbn) {
      var request = new XMLHttpRequest();
      request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
              var json_obj = JSON.parse(request.responseText);
              var items = json_obj.items;
              var html_text = '';
              // var index = 0;

              for (item of items) {
                  var image = item.volumeInfo.imageLinks.thumbnail;
                  var title = item.volumeInfo.title;
                  var desc = item.volumeInfo.description;
                  var author = item.volumeInfo.authors;

                  
                  if ( typeof desc !== 'undefined' ) {
                    if (desc.length > 150) {
                      desc = desc.slice(0,120) + '...';
                    }
                  }
                  else {
                    desc = 'description not available';
                  }

                  // referenced from: https://jsfiddle.net/bootstrapious/b69yeLzj
                  var node = document.createElement('div');
                  node.setAttribute('class', 'col-xl-3 col-sm-4 mb-5 my-2');
                  // node.setAttribute('onclick', `redirect(${isbn})`);
                  node.setAttribute('style', 'display:flex; justify-content: center; align-items: center; text-align: center;');
                  node.innerHTML += `
                  
                  <div class="mybooks rounded shadow-sm">
                  <div id="bookstuff" onclick="redirect(${isbn})">
                      <img src="${image}" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">${title}</h5><span class="small text-muted">by ${author}</span><br><br>
                  </div>

                      <form method="post" name="form" action="mybooks.php">
                        <button class="btn btn-danger" style="margin-bottom:0px;" name="deletebookmark" value="${isbn}">Temporary</button>
                      </form>
                      
                      
                  </div>
        
                  
                  
                  `;

                  // <div class="each-book">
                  //     <div class="each-img"><img src="${image}" width="100%" height="100%" style="border-radius: 2%;"></div>
                  //     <div class="main-details">
                  //         <span id ='title' style='font-size:15px;'><a href=''>${title}</a></span>
                  //         <button class="btn btn-danger" onclick="deleteBook()" id='${isbn}' style="float: right">Delete</button>
                  //         <br>
                  //         <span style='font-size:13px;'>by ${author}</span>
                          
                  //     </div>
                      
                  // </div>

                  index += 1;
                  // console.log(index);


              }

              document.getElementById('wishlist_cards').appendChild(node);


      }
  }


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
              // var x = 1;
              var html_text = "";
              

              for (item of items) {
                  console.log(item);
                  var image = item.volumeInfo.imageLinks.thumbnail;
                  var title = item.volumeInfo.title;
                  var desc = item.volumeInfo.description;
                  var author = item.volumeInfo.authors;

                  
                  if ( typeof desc !== 'undefined' ) {
                    if (desc.length > 150) {
                      desc = desc.slice(0,120) + '...';
                    }
                  }
                  else {
                    desc = 'Description not available';
                  }


                  // referenced from: https://jsfiddle.net/bootstrapious/b69yeLzj
                  var node = document.createElement('div');
                  node.setAttribute('class', 'col-xl-3 col-sm-4 mb-5 my-2');
                  // node.setAttribute('onclick', `redirect(${isbn})`);
                  node.setAttribute('style', 'display:flex; justify-content: center; align-items: center; text-align: center;');
                  node.innerHTML += `
                  
                  <div class="mybooks rounded shadow-sm">
                  <div id="bookstuff" onclick="redirect(${isbn})">
                    <img src="${image}" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">${title}</h5><span class="small text-muted">by ${author}</span><br><br>
                  </div>
                      <form method="post" name="form" action="mybooks.php">
                        <button class="btn btn-danger" style="margin-bottom:0px;" name="deletelisting" value="${isbn}">Temporary</button>
                      </form>
                      
                  </div>
                  `;

                  x += 1;
                  // console.log(x);

              }

              document.getElementById('myListings_cards').appendChild(node);


          }
      }


      var url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`;

      request.open("GET", url, true);

      request.send();



  }

  function deleteBook(isbn) {
    if (confirm("Are you sure you want to delete this book?")) {
      alert(isbn);
      var userid = "<?php echo $userid ?>";
      console.log(userid);

      <?php 
        $_SESSION['deleteisbn'] = "<script>document.writeln(isbn);</script>";

      

      ?>
      // location.reload();
      
    }

  }


// autocomplete




</script>




  

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