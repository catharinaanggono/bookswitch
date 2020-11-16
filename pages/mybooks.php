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

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600&display=swap" rel="stylesheet">

    <link href="../css/homepage.css" rel="stylesheet" />
    <link href="../css/bookswitch.css" rel="stylesheet" />
    <link href="../css/book_genre.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Core theme JS-->
    <!-- <script src="../js/homepage.js"></script> -->


    <title>My Books</title>


    <title>BookSwitch</title>
    

    <style>


      body {
        padding-top: 0px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        margin-bottom: 0px;
        height: 100%;

      }

      #wishlist_cards, #myListings_cards {

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

      .black-background {
        background-color:#0D3D54;
      }

      .white {
        color:#ffffff;
      }

      .red {
        color:red;
      }

      /* colour of tabs when dark mode is on */
      #all_tab.dark, #reserved_tab.dark, #exchange_tab.dark {
        color: #dedbc1;
      }


      #all_tab.active, #reserved_tab.active, #exchange_tab.active {
        color: #474E45;
      }

      .tab-content {
        padding-left: 5%;
        padding-right: 5%;
        min-height: 250px;
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

      /* footer css */
      footer{
          background-color: #6b7269;
          color: white;
          position: relative;
          bottom: 0;
          width: 100%;
          min-height: 100%;
          height: auto !important;
          height: 100%;
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
                <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../images/bookswitch.svg" alt="" /></a>
                <div class="d-flex flex-row order-2 order-lg-3">

                    <ul class = "navbar-nav">
                      <li class="nav-item nav-link" id="bookens"><span style="color:#474E45;"><?php echo $_SESSION['bookens'];?></span><img src="../images/bookens_circle.svg" width="17" height="17"></a></li>
                    </ul>

                    <button class="navbar-toggler navbar-toggler-right ml-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <!-- Menu -->
                        <i class="fas fa-bars ml-1"></i>
                    </button>
                </div>
                
                <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../pages/book_genre.php">Genre</a></li>
                        <li class="nav-item">
                          <div class="search" id="search">
                            <input id="my_autocomplete" type="text" placeholder="Search Title, Author, ISBN">
                          </div>
                        </li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="../pages/mybooks.php"><i class="far fa-user"></i><?php echo $_SESSION['userid'];?></a></li>
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
          
        <!-- <?php } ?> -->
  
    
    <div class="jumbotron jumbotron-fluid" id="mybooksHeader" style="padding-left: 5%; padding-right: 5%;">
      <div class="row">
        <h1 class="display-4 col-4" style="margin-bottom: 50px; margin-top:50px;">My Books</h1>
        <div class="col-8" style="display:flex; justify-content: center; align-items: center;">
          <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills text-center border-0 rounded-nav" style="width: 70%;">
                <!-- Bookmarks tab -->
                <li class="nav-item " style="width: 50%">
                  <a data-toggle="tab" id="wishlist_tab" href="#wishlist" role="tab" aria-controls="home" aria-selected="true" onclick="get_Bookmark()" onclick="openLink(event, 'Left')" class="nav-link border-0 text-uppercase font-weight-bold active" style="margin-bottom:0px;"><img src="../images/bookmarks_nobg.png" width="50%" height="auto"></a>
                </li>
                <!-- Listings tab -->
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
      // if delete bookmark button has been pressed, delete the bookmark, then remove the $_POST
      if (isset($_POST['deletebookmark'])) {
        $isbn = $_POST['deletebookmark'];
        $dao->deleteBookmark($userid,$isbn);
        unset($_POST['deletebookmark']);
      }

      // if delete listing button has been pressed, delete the listing, then remove the $_POST
      if (isset($_POST['deletelisting'])) {
        $isbn = $_POST['deletelisting'];
        $dao2->deleteListing($isbn);
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

              <!-- bookmarks displayed here -->
              <div id="wishlist_cards" class="row"></div>

        
        </div>

        <div class="tab-pane fade" id="listings" role="tabpanel" aria-labelledby="listings-tab">
            
            <!-- My listings stuff here -->

            <ul class="nav nav-tabs">
              <!-- All tab -->
              <li class="nav-item">
                <a class="nav-link active" id="all_tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true" onclick="getListings('ALL')">All</a>
              </li>
              <!-- Books Exchange History tab -->
              <li class="nav-item">
                <a class="nav-link" id="reserved_tab" data-toggle="tab" href="#reserved" role="tab" aria-controls="reserved" aria-selected="true" onclick="getListings('YES')">Books Exchange History</a>
              </li>
              <!-- Books Up for Exchange tab -->
              <li class="nav-item">
                <a class="nav-link" id="exchange_tab" data-toggle="tab" href="#notreserved" role="tab" aria-controls="notreserved" aria-selected="true" onclick="getListings('NO')">Books Up for Exchange</a>
              </li>
            </ul>

              <!-- Listings displayed here (depending on tab pressed) -->
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
  
  // Dark mode functions
  const chk = document.getElementById('chk');

  chk.addEventListener('click', () => {
    chk.checked?document.body.classList.add("dark"):document.body.classList.remove("dark");
    h4 = document.getElementsByTagName('h4');
    for (x of h4){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }
    h2 = document.getElementsByTagName('h2');
    for (x of h2){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }
    a = document.getElementsByTagName('a');
    for (x of a){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }
    books = document.getElementsByClassName('each-book');
    for (x of books){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }
    genre = document.getElementsByClassName('genre');
    for (x of genre){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }
    bookDetails = document.getElementsByClassName('bookDetails');
    for (x of bookDetails){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }
    headerNames = document.getElementsByClassName('headerNames');
    for (x of headerNames){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }

    header = document.getElementsByTagName('header');
    for (x of header){
      chk.checked?x.classList.add("dark"):x.classList.remove("dark");
    }


  
    localStorage.setItem('darkModeStatus', chk.checked);
  });

  window.addEventListener('load', (event) => {
    if(localStorage.getItem('darkModeStatus')=="true"){
      document.body.classList.add("dark"); 
      h4 = document.getElementsByTagName('h4');
      for (x of h4){
        x.classList.add("dark");
      }
      h2 = document.getElementsByTagName('h2');
      for (x of h2){
        x.classList.add("dark");
      }
      a = document.getElementsByTagName('a');
      for (x of a){
        x.classList.add("dark");
      }
      books = document.getElementsByClassName('each-book');
      for (x of books){
        x.classList.add("dark");
      }
      genre = document.getElementsByClassName('genre');
      for (x of genre){
        x.classList.add("dark");
      }

      bookDetails = document.getElementsByClassName('bookDetails');
      for (x of bookDetails){
        x.classList.add("dark");
      }
      headerNames = document.getElementsByClassName('headerNames');
      for (x of headerNames){
        x.classList.add("dark");
      }

      header = document.getElementsByTagName('header');
      for (x of header){
        x.classList.add("dark");
      }
      document.getElementById('chk').checked = true;
    }
  });

  // Dark mode functions end


  
  function redirect(isbn) {
      location.href = `bookdetails.php?isbn=${isbn}`;
      console.log(index);
      document.getElementById('title').getElementsByTagName('a')[0].setAttribute('href', `bookdetails.php?isbn=${isbn}`);
  }

  // function show_desc(id) {
  //     var node = document.getElementById(id);
  //     node.setAttribute('style', 'visibility: visible;');
  // }

  // function hide_desc(id) {
  //     var node = document.getElementById(id);
  //     node.setAttribute('style', 'visibility: hidden;');
  // }

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
                  node.setAttribute('style', 'display:flex; justify-content: center; align-items: center; text-align: center;');
                  node.innerHTML += `
                  
                  <div class="mybooks rounded shadow-sm">
                    <div id="bookstuff" onclick="redirect(${isbn})" class="overflow-auto">
                        <img src="${image}" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
                          <h5 class="mb-0">${title}</h5><span class="small text-muted">by ${author}</span><br><br>
                    </div>

                    <form method="post" name="form" action="mybooks.php" style="padding-bottom: 10px;">
                      <button class ='btn btn black-background white' style="margin-bottom:0px;" name="deletebookmark" value="${isbn}">Remove  <i class='far fa-bookmark red'></i></button>
                    </form>
                  </div>
                  `;
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
              var html_text = "";
              
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
                    desc = 'Description not available';
                  }

                  // referenced from: https://jsfiddle.net/bootstrapious/b69yeLzj
                  var node = document.createElement('div');
                  node.setAttribute('class', 'col-xl-3 col-sm-4 mb-5 my-2');
                  // node.setAttribute('onclick', `redirect(${isbn})`);
                  node.setAttribute('style', 'display:flex; justify-content: center; align-items: center; text-align: center;');
                  node.innerHTML += `
                  
                  <div class="mybooks rounded shadow-sm">
                    <div id="bookstuff" onclick="redirect(${isbn})" class="overflow-auto">
                      <img src="${image}" alt="" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
                          <h5 class="mb-0">${title}</h5><span class="small text-muted">by ${author}</span><br><br>
                    </div>
                    <form method="post" name="form" action="mybooks.php" style="padding-bottom:10px;">
                      <button class="btn btn black-background white" style="margin-bottom:0px;" name="deletelisting" value="${isbn}">Remove Listing</button>
                    </form>
                  </div>
                  `;
              }

              document.getElementById('myListings_cards').appendChild(node);
          }
      }


      var url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`;

      request.open("GET", url, true);

      request.send();

  }


  $("#my_autocomplete").autocomplete({
    appendTo: $('#search'),
    source: function (request, response) {
      $.ajax({
        url: "https://www.googleapis.com/books/v1/volumes?",
        data: { 
          q: request.term,
          startIndex: 1,
          maxResults: 15
        },
        success: function (data) {
          data = data.items;
          var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");
  
          console.log(data);
  
          var primary_matches = $.map(data, function (el) {
            let result = el.volumeInfo.title;
            let img_link = el.volumeInfo.imageLinks;
            let authors = el.volumeInfo.authors;
            console.log(authors);
            if (typeof img_link !== 'undefined'){
              img_link = el.volumeInfo.imageLinks.thumbnail;
            }
            else{
              img_link = '../images/no_image-removebg-preview.svg'
            }
            if (typeof authors == 'undefined'){
              authors = "AUTHOR UNKNOWN";
            }            
            if (matcher1.test(result) || matcher1.test(authors)){
              return {
                imgLink: img_link,
                value: result,
                author: authors
              };
  
            }
              
          });
          var secondary_matches = $.map(data, function (el) {
            let result = el.volumeInfo.title;
            let img_link = el.volumeInfo.imageLinks;
            let authors = el.volumeInfo.authors;
            console.log("2" + authors);

            if (typeof img_link !== 'undefined'){
              img_link = el.volumeInfo.imageLinks.thumbnail;
            }
            else{
              img_link = '../images/no_image-removebg-preview.svg'
            }
            if (typeof authors == 'undefined'){
              authors = "AUTHOR UNKNOWN";
            }       
            if (matcher2.test(result) || matcher2.test(authors)){
              return {
                imgLink: img_link,
                value: result,
                author: authors
              };
  
            }
              
          });
          console.log(primary_matches);
          console.log(secondary_matches);
          response($.merge(primary_matches, secondary_matches));
        },
        
      });
    }
  })
  .data("ui-autocomplete")._renderItem = function( ul, item ) {
        var titleText = String(item.value).replace(
        new RegExp(this.term, "gi"),
        "<span class='ui-state-highlight'><b>$&</b></span>");
        var authorText = String(item.author).replace(
        new RegExp(this.term, "gi"),
        "<span class='ui-state-highlight'><b>$&</b></span>");

        return $( "<li></li>" )
        .attr( "data-value", item)
        .append("<div class='row'><div class='col-3'><img width='62' height='85' src='" + item.imgLink + "'></div>" + "<div class='col'><div class='row'><div class='col'><p style='font-size:15px'>" + titleText + "</p></div></div>" + "<div class='row'><div class='col'><p style='font-size:10px'>" + authorText + "</p></div></div></div>")
        .appendTo( ul );
    };

  //  to redirect upon clicking enter
  document.getElementById("my_autocomplete").onkeypress = function(event){
    if (event.keycode == 13 || event.which == 13){
      var query = document.getElementById("my_autocomplete").value;
      var category = 'all';
      redirect_to_book_search_personal(query, category);
    }
  };

  // for Quick Search redirect
  function redirect_to_book_search_personal(query, category){
    location.href = `book_search.php?query=${query}&category=${category}`;
  }

</script>




  

    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->   

  </body>
  
</html>