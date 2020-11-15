<?php
    session_start();
    $_SESSION["redirect_to"] = 'book_genre.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- jQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="../css/homepage.css" rel="stylesheet" />
    <link href="../css/book_genre.css" rel="stylesheet" href="">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600&display=swap" rel="stylesheet">

    <title>BookSwitch</title>
    <style>
        body {
            font-family: 'Segoe UI';
            padding-top: 100px;
        }
    </style>

    <?php 

        if (isset($_GET["query"])) {
          $query = $_GET["query"]; 
          $_SESSION["query"] = $query; 
        }

        if (isset($_GET["category"])) {
          $category = $_GET["category"]; 
          $_SESSION["category"] = $category; 
        }

    ?>

</head>
<body>
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
            <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="../pages/book_genre.php">Genre</a></li>
            <li class="nav-item">
              <div class="search" id="search">
                <input id="my_autocomplete" type="text" placeholder="Search Title, Author, ISBN">
              </div>
            </li>
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
        <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../images/bookswitch.svg" alt="" /></a>
        <div class="d-flex flex-row order-2 order-lg-3">
          <button class="navbar-toggler navbar-toggler-right ml-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Menu -->
            <i class="fas fa-bars ml-1"></i>
          </button>
        </div>
        
        <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="../pages/book_genre.php" >Genre</a></li>
            <li class="nav-item">
              <div class="search" id="search">
                <input id="my_autocomplete" type="text" placeholder="Search Title, Author, ISBN">
              </div>
            </li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login.php"><i class="far fa-user"></i>Login</a></li>
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
    
  <!-- Pagination -->
  <div class="pagination justify-content-center" id="pagination"> </div>

  <!-- genre -->
  <!-- adv, children, fantasy,mystery, romance -->
  <div class="container text-center" id="glist" class='glist'>
      <button type="button" class="btn genre m-1" id='Adventure' onclick="call_api_genre('Adventure', 0); update_header(id);">Adventure</button>
      <button type="button" class="btn genre m-1" id='Children' onclick="call_api_genre('Children', 0); update_header(id);">Children</button>
      <button type="button" class="btn genre m-1" id='Fantasy' onclick="call_api_genre('Fantasy', 0); update_header(id);">Fantasy</button>
      <button type="button" class="btn genre m-1" id='Mystery' onclick="call_api_genre('Mystery', 0); update_header(id);">Mystery</button>
      <button type="button" class="btn genre m-1" id='Romance' onclick="call_api_genre('Romance', 0); update_header(id); ">Romance</button>
  </div>

  <br>

  <div id='genre-header' class="jumbotron jumbotron-fluid mx-auto py-3" style="width: 93%; border-radius: 5px;">
    <div class="container">
      <h4 id="gtitle" class="display-4" style="text-align: center;">Mystery</h4>
      <p id="gdesc" class="lead">The primary focus of romance fiction is on the relationship and romantic love between two people. These books have an emotionally satisfying and optimistic ending.</p>
    </div>
  </div>
  <div class="container">
    <div class="row">

    </div>
  </div>
  <!-- Page Content -->
  <div class="container-fluid" style="width: 95%;" >
    <div class="row" id="main-content">
        
    </div>
    <!-- /.row -->
  </div>

  <br>

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
      </div>
    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright - BookSwitch</div>
  </footer>
  <!-- End of Footer -->

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <!-- BookSwitch JS -->
  <script src="../js/homepage.js"></script>
  <script src="../js/book_genre.js"></script>
    
    




</body>
</html>