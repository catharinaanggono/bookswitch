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
    <script src='../js/bookdetails.js'></script>

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

        body {
            color: #474E45;
        }
        
        button,input {
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, 
            "Helvetica Neue", Arial, sans-serif, 
            "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        button:hover, #able_submit:hover {
            background-color: #A94241;
        }

        footer {
            padding-top: 50px;
        }

        footer{
            background-color: #6b7269;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer a{
            color: #B5C587;
        }

        footer a:hover{
            color: #B5C587;
        }
       
    </style>

    <?php 

            if (isset($_GET["isbn"])) {
                $isbn = $_GET["isbn"]; 
                $_SESSION["isbn"] = $isbn; 
            } else {
                header("location:../index.php");
            }

    ?>

</head>

<?php 
	require_once "../model/common.php";
?>

<body onload="display_default('<?php echo $_GET['isbn']; ?>')" >
    
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
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../pages/book_genre.php">Genre</a></li>
                        <li class="nav-item">
                          <div class="search" id="search">
                            <input id="my_autocomplete" type="text" placeholder="Search Title, Author, ISBN">
                          </div>
                        </li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login.php?redirect_to=book_search.php"><i class="far fa-user"></i>Login</a></li>
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
    
    <!-- Modal -->
    
    <div class="modal fade" id="exampleModal" style = "padding-top: 100px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                } else {
                    if (isset($_SESSION["bookmark"])) { 
                        echo " Your selection has been bookmarked. <br> 
                        Please proceed to your profile to view your bookmarks.";
                    } else {
                        echo " Your selection has removed from your bookmarks."; 
                    }
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
    
    <br><br>
    <div style = "padding-left:10px;"><button style = 'color:white;' class="btn black-background white chevron-left" onclick="history.go(-1);"><i class="fas fa-chevron-left"></i></button></div>

    <div class = "container-fluid" style = "padding-top: 30px; padding-bottom: 5%;">
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
                                $avgRate = $dao3->getRatings($isbn);
                              
                                if ($avgRate != "Nothing") {

                                    if ($avgRate > 5) {
                                        $avgRate = 5;
                                    }

                                    for ($i=0;$i<$avgRate;$i++) {
                                        echo "<span class='fa fa-star checked'></span>";
                                    } 
    
                                    $noStars = 5 - $avgRate; 
                                    if ($noStars > 0) {
                                        for ($i=0;$i<$noStars;$i++) {
                                            echo "<span class='fa fa-star'></span>";
                                        }
                                    }
                                } 
                            ?>
                          </p>
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
            echo "   <button type='submit' style = 'color:white;' name = 'bookmark' class='btn black-background white'>
            <i class='far fa-bookmark'></i>
            </button>";
            
        } else { 
            echo "   <button name='bk' type='submit' style = 'color:white;'style = 'color:white;' value='bk' class ='btn black-background white' >
            <i class='far fa-bookmark red'></i></button>";
        }

        if ($checkAvailQty == []) {
            echo "    
            <input type='submit' id = 'disabled_submit' name = 'getCopy' style = 'color:white;' value ='Get a Copy' class='btn black-background white' disabled>";
        } else { 
            echo "    
            <input type='submit' id = 'able_submit'  name = 'getCopy' style = 'color:white;' value ='Get a Copy' class='btn black-background white'>";
        }

        echo "</form>";
    ?>

            </div>
          </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- BookSwitch JS -->
    <script src='../js/homepage.js'></script>
    
    <script>
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

</body>


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

</html>