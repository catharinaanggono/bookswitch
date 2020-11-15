<?php
  session_start();
  $_SESSION["redirect_to"] = '../index.php'; 
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Book Switch</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <!--Search Icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <link href="./css/homepage.css" rel="stylesheet" />
    
  </head>
    <body id="page-top">
      <!-- Navigation-->
      <?php if (isset($_SESSION['userid']) or !empty($_SESSION['userid'])) { // or however you determine they're logged in ?>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="./images/bookswitch.svg" alt="" /></a>
          <div class="d-flex flex-row order-2 order-lg-3">
            <ul class = "navbar-nav">
                <li class="nav-item nav-link" id="bookens"><span style="color:#474E45;"><?php echo $_SESSION['bookens'];?></span><img src="./images/bookens_circle.svg" width="17" height="17"></a></li>
            </ul>

            <button class="navbar-toggler navbar-toggler-right ml-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Menu -->
                <i class="fas fa-bars ml-1"></i>
            </button>
          </div>
            
          <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
              <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./pages/book_genre.php">Genre</a></li>
              <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./pages/mybooks.php"><i class="far fa-user"></i><?php echo $_SESSION['userid'];?></a></li>
              <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./pages/logout.php">Logout</a></li>
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
            <a class="navbar-brand js-scroll-trigger" href="homepage.php"><img src="./images/bookswitch.svg" alt="" /></a>
            <div class="d-flex flex-row order-2 order-lg-3">
              <button class="navbar-toggler navbar-toggler-right ml-auto" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Menu -->
                <i class="fas fa-bars ml-1"></i>
              </button>
            </div>
              
            <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarResponsive">
              <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./pages/book_genre.php">Genre</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./pages/login.php"><i class="far fa-user"></i>Login</a></li>
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

        <!-- Masthead-->
        <header class="masthead">
          <div class="container">
            <h1 class="animate__animated animate__bounce animate__delay-1s	 animate__slow" style="color: #0D3D54;">Switch Your Book</h1>
            <h1 class="animate__animated animate__bounce animate__delay-3s animate__slow" style="color: #A94241 ;">Discover More Books</h1>

            <ul style="position: relative; z-index: 5555;" class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#title" role="tab" aria-controls="title" aria-selected="true">Title</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#author" role="tab" aria-controls="author" aria-selected="false">Author</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#isbn" role="tab" aria-controls="isbn" aria-selected="false">ISBN</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="home_searchbar">
                  <label>
                    <input style="position: relative; z-index: 5555;" id="all_autocomplete" type="search" class="search-field" placeholder="Search all..." onChange="aliasonclick"/>
                  </label>
                  <input name="searchbutton" id="all_searchbtn" style="position: relative; z-index: 5555;" type="submit" class="search-submit button" value="&#xf002" onclick="all_search('all')"/>
                </div>
              </div>

              <div class="tab-pane fade" id="title" role="tabpanel" aria-labelledby="title-tab">
                <div class="home_searchbar">
                  <label>
                    <span class="screen-reader-text">Search for...</span>
                    <input  style="position: relative; z-index: 5555;" id="title_autocomplete" type="search" class="search-field" placeholder="Search title..." value="" name="s" title=""/>
                  </label>
                  <input style="position: relative; z-index: 5555;" type="submit" class="search-submit button" value="&#xf002" onclick="title_search('intitle')"/>
                </div>
              </div>

              <div class="tab-pane fade" id="author" role="tabpanel" aria-labelledby="author-tab">
                <div class="home_searchbar">
                  <label>
                    <span class="screen-reader-text">Search for...</span>
                    <input style="position: relative; z-index: 5555;" id="author_autocomplete" type="search" class="search-field" placeholder="Search author..." value="" name="s" title="" />
                  </label>
                  <input style="position: relative; z-index: 5555;" type="submit" class="search-submit button" value="&#xf002" onclick="author_search('inauthor')"/>
                </div>
              </div>

              <div class="tab-pane fade" id="isbn" role="tabpanel" aria-labelledby="isbn-tab">
                <div class="home_searchbar">
                  <label>
                    <span class="screen-reader-text">Search for...</span>
                    <input style="position: relative; z-index: 5555;" id="isbn_autocomplete" type="search" class="search-field" placeholder="Search ISBN..." value="" name="s" title="" />
                  </label>
                  <input style="position: relative; z-index: 5555;" type="submit" class="search-submit button" value="&#xf002" onclick="isbn_search('isbn')"/>
                </div> 
              </div>
              
            </div>
            <div class="leaf">
              <div><img src="./images/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px" ></img></div>
              <div><img  src="./images/Green-Leaves-PNG-File.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Transparent-Autumn-Leaves-Falling-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
              <div><img src="./images/autumn_leaves.png" height="75px" width="75px"></div>    
            </div>
            
            <div class="leaf leaf1">
              <div><img src="./images/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px" ></img></div>
              <div><img  src="./images/Green-Leaves-PNG-File.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Transparent-Autumn-Leaves-Falling-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
              <div><img src="./images/autumn_leaves.png" height="75px" width="75px"></div>     
            </div>
              
            <div class="leaf leaf2">
              <div><img src="./images/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px" ></img></div>
              <div><img  src="./images/Green-Leaves-PNG-File.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Transparent-Autumn-Leaves-Falling-PNG.png" height="75px" width="75px"></img></div>
              <div><img src="./images/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
              <div><img src="./images/autumn_leaves.png" height="75px" width="75px"></div>
            </div>
          </div>
        </header>
        
        
    <!-- ======= Steps Section ======= -->
    <section id="steps" class="steps section-bg">
      <div class="container">
        <h2 style="color:#B5C587">How To</h2>
        <div class="row no-gutters">
  
          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in">
            <span>Step 1</span>
            <h4>Login</h4>
            <p>Login to your account</p>
          </div>
    
          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" data-aos-delay="100">
            <span>Step 2</span>
            <h4>Upload Books for Exchange</h4>
            <p>Upload the books you are not going to read anymore and list them for exchange</p>
          </div>
    
          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" data-aos-delay="200">
            <span>Step 3</span>
            <h4>Earn Bookens</h4>
            <p>Earn 50 Bookens for every book you give away</p>
          </div>
    
          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" data-aos-delay="300">
            <span>Step 4</span>
            <h4>Browse Books</h4>
            <p>You can browse books by title, author, isbn or genre</p>
          </div>
    
          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" data-aos-delay="400">
            <span>Step 5</span>
            <h4>Bookmark Books</h4>
            <p>You can bookmark books that you find interesting so that you can refer back to them under your account</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" data-aos-delay="500">
            <span>Step 6</span>
            <h4>Redeem Bookens</h4>
            <p>Pick books from the pool of uploaded books listed for exchange by other users for free by redeeming your Bookens, each book costs 50 Bookens</p>
          </div>
        </div>    
      </div>
    </section>
    <!-- End Steps Section -->
    
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
              <img src='./images/bookswitch_footer.svg' style='width: 200px; height: 80px;'>
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
       
        
    <!-- Bootstrap core JS-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="./js/homepage.js"></script>

    </body>
</html>
