//Dark Mode
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


(function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 72,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".js-scroll-trigger").click(function () {
        $(".navbar-collapse").collapse("hide");
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $("body").scrollspy({
        target: "#mainNav",
        offset: 74,
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
})(jQuery); // End of use strict



// Show nav bar on scroll up, hide nav bar on scroll down
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("mainNav").style.top = "0";
  } else {
    document.getElementById("mainNav").style.top = "-100px";
  }
  prevScrollpos = currentScrollPos;
}


// Search All Method
$("#all_autocomplete").autocomplete({
  appendTo: $('#all'),
  select: function( event, ui ){
    // Redirect to the url
    redirect_hp(ui.item.isbn);

  },
  source: function (request, response) {
    $.ajax({
      url: "https://www.googleapis.com/books/v1/volumes?",
      data: { 
        q: request.term,
        startIndex: 1,
        maxResults: 15
      },
      autoFocus: true,
      success: function (data) {
        data = data.items;
        var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
        var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");
        var primary_matches = $.map(data, function (el) {
          let result = el.volumeInfo.title;
          let img_link = el.volumeInfo.imageLinks;
          let authors = el.volumeInfo.authors;
          let isbn = el.volumeInfo.industryIdentifiers;
          if (typeof img_link !== 'undefined'){
            img_link = el.volumeInfo.imageLinks.thumbnail;
          }
          else{
            img_link = '../images/no_image-removebg-preview.svg'
          }
          if (typeof authors == 'undefined'){
            authors = "AUTHOR UNKNOWN";
          }
          if (typeof isbn !== 'undefined'){
            isbn = el.volumeInfo.industryIdentifiers[0].identifier;
          }
          else{
            isbn = '';
          }

          if (matcher1.test(result) || matcher1.test(authors)){
            return {
              imgLink: img_link,
              value: result,
              author: authors,
              isbn: isbn
              
            };

          }
            
        });
        var secondary_matches = $.map(data, function (el) {
          let result = el.volumeInfo.title;
          let img_link = el.volumeInfo.imageLinks;
          let authors = el.volumeInfo.authors;
          let isbn = el.volumeInfo.industryIdentifiers;

          if (typeof img_link !== 'undefined'){
            img_link = el.volumeInfo.imageLinks.thumbnail;
          }
          else{
            img_link = '../images/no_image-removebg-preview.svg'
          }
          if (typeof authors == 'undefined'){
            authors = "AUTHOR UNKNOWN";
          }
          if (typeof isbn !== 'undefined'){
            isbn = el.volumeInfo.industryIdentifiers[0].identifier;
          }
          else{
            isbn = '';
          }

          if (matcher2.test(result) || matcher2.test(authors)){
            return {
              imgLink: img_link,
              value: result,
              author: authors,
              isbn: isbn
            };

          }
            
        });
        
        response($.merge(primary_matches, secondary_matches));
      },
      select: function (event, ui) {
        alert("Item Clicked"); //Fires Ok             
       window.location.href("http://localhost/bookswitch/book-switch-i216/pages/book_genre.php"); // Works but totally unacceptable, browser history lost etc..          }    
      }
      
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

// Search Title Method
$("#title_autocomplete").autocomplete({
  appendTo: $('#title'),
  select: function( event, ui ){
    // Redirect to the url
    redirect_hp(ui.item.isbn);

  },
  source: function (request, response) {
    $.ajax({
      url: "https://www.googleapis.com/books/v1/volumes?",
      data: { 
        q: "intitle:" + request.term,
        startIndex: 1,
        maxResults: 15
      },
      success: function (data) {
        data = data.items;
        var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
        var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");

        var primary_matches = $.map(data, function (el) {
          let result = el.volumeInfo.title;
          let img_link = el.volumeInfo.imageLinks;
          let authors = el.volumeInfo.authors;
          let isbn = el.volumeInfo.industryIdentifiers;
          if (typeof img_link !== 'undefined'){
            img_link = el.volumeInfo.imageLinks.thumbnail;
          }
          else{
            img_link = '../images/no_image-removebg-preview.svg'
          }
          if (typeof authors == 'undefined'){
            authors = "AUTHOR UNKNOWN";
          }
          if (typeof isbn !== 'undefined'){
            isbn = el.volumeInfo.industryIdentifiers[0].identifier;
          }
          else{
            isbn = '';
          }

          if (matcher1.test(result)){
            return {
              imgLink: img_link,
              value: result,
              author: authors,
              isbn: isbn

            };

          }
            
        });
        var secondary_matches = $.map(data, function (el) {
          let result = el.volumeInfo.title;
          let img_link = el.volumeInfo.imageLinks;
          let authors = el.volumeInfo.authors;
          let isbn = el.volumeInfo.industryIdentifiers;
          if (typeof img_link !== 'undefined'){
            img_link = el.volumeInfo.imageLinks.thumbnail;
          }
          else{
            img_link = '../images/no_image-removebg-preview.svg'
          }
          if (typeof authors == 'undefined'){
            authors = "AUTHOR UNKNOWN";
          }
          if (typeof isbn !== 'undefined'){
            isbn = el.volumeInfo.industryIdentifiers[0].identifier;
          }
          else{
            isbn = '';
          }

          if (matcher2.test(result)){
            return {
              imgLink: img_link,
              value: result,
              author: authors,
              isbn: isbn

            };

          }
            
        });
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

//Search by Author Method
$("#author_autocomplete").autocomplete({
  appendTo: $('#author'),
  source: function (request, response) {
    $.ajax({
      url: "https://www.googleapis.com/books/v1/volumes?",
      data: { 
        q: "inauthor:" + request.term,
        startIndex: 1,
        maxResults: 15
      },
      success: function (data) {
        data = data.items;
        var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
        var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");

        var primary_matches = $.map(data, function (el) {

          let result = el.volumeInfo.authors;
          
          if (typeof result == 'undefined'){
            result = "AUTHOR UNKNOWN";
          }
          
          if (matcher1.test(result)){
            return {
              value: result
            };
          }   
        });
        var secondary_matches = $.map(data, function (el) {
          let authors = el.volumeInfo.authors;
          if (typeof result == 'undefined'){
            result = "AUTHOR UNKNOWN";
          }       
          if (matcher2.test(result)){
            return {
              value: result
            };

          }
            
        });
        primary_matches = unique(primary_matches);
        response(primary_matches);
      },
    });
  }
})
.data("ui-autocomplete")._renderItem = function( ul, item ) {
            var authorText = String(item.value).replace(
              new RegExp(this.term, "gi"),
              "<span class='ui-state-highlight'><b>$&</b></span>");
            return $( "<li></li>" )
            .attr( "data-value", item)
            .append("<div><a>" + authorText + "</a></div>")
            .appendTo( ul );
        };

function unique(list) {
  var result = [];
  $.each(list, function (i, e) {
    var matchingItems = $.grep(result, function (item) {
       return item.value[0] === e.value[0];
    });
    if (matchingItems.length === 0){
        result.push(e);
    }
  });
  return result;
}

// to redirect to book details page
function redirect_hp(isbn){
  location.href = `./pages/bookdetails.php?isbn=${isbn}`;
  document.getElementById('title').getElementsByTagName('a')[0].setAttribute('href', `bookdetails.php?isbn=${isbn}`);
}

document.getElementById("all_autocomplete").onkeypress = function(event){
  if (event.keycode == 13 || event.which == 13){
    var query = document.getElementById("all_autocomplete").value;
    var category = 'all';
    redirect_to_book_search(query, category);
  }
};

document.getElementById("title_autocomplete").onkeypress = function(event){
  if (event.keycode == 13 || event.which == 13){
    var query = document.getElementById("title_autocomplete").value;
    var category = 'intitle';
    redirect_to_book_search(query, category);
  }
};

document.getElementById("author_autocomplete").onkeypress = function(event){
  if (event.keycode == 13 || event.which == 13){
    var query = document.getElementById("author_autocomplete").value;
    var category = 'inauthor';
    redirect_to_book_search(query, category);
  }
};

document.getElementById("isbn_autocomplete").onkeypress = function(event){
  if (event.keycode == 13 || event.which == 13){
    var query = document.getElementById("isbn_autocomplete").value;
    var category = 'isbn';
    redirect_to_book_search(query, category);
  }
};


function redirect_to_book_search(query, category){
    location.href = `./pages/book_search.php?query=${query}&category=${category}`;
  }

function all_search(category){
  var query = document.getElementById("all_autocomplete").value;
  location.href = `./pages/book_search.php?query=${query}&category=${category}`;
}

function title_search(category){
  var query = document.getElementById("title_autocomplete").value;
  location.href = `./pages/book_search.php?query=${query}&category=${category}`;
}

function author_search(category){
  var query = document.getElementById("author_autocomplete").value;
  location.href = `./pages/book_search.php?query=${query}&category=${category}`;
}

function isbn_search(category){
  var query = document.getElementById("isbn_autocomplete").value;
  location.href = `./pages/book_search.php?query=${query}&category=${category}`;
}
