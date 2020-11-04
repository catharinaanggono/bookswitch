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

var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("mainNav2").style.top = "0";
  } else {
    document.getElementById("mainNav2").style.top = "-100px";
  }
  prevScrollpos = currentScrollPos;
}



// Search All Method
function searchAll(query) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {
            var response_json = JSON.parse(this.responseText);
            console.log(response_json.items);
            response_json = response_json.items;
            var objkeys = Object.keys(response_json);

            for(var i of objkeys){

                // var node = document.getElementById("winners_list");
                // node.innerHTML += '<div class="card"><img src="../api/images/' + response_json[i].others.image + '" class="card-img-top"><div class="card-body"><h5 class="card-title">' + response_json[i].bio.name + '</h5><p id="movie-title">' + response_json[i].movie.title + ' (' + response_json[i].movie.year + ')' + '</p><p id="details">' + response_json[i].movie.description + '</p></div>';

                

            }
        }

    }; // End-of-function


    var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
    var url = 'https://www.googleapis.com/books/v1/volumes?q=' + query;


    console.log(url);

    request.open("GET", url, true);
    request.send();
}


// Search by Title Method


// Search by Author Method


// Search by ISBN Method


// Autocomplete
$("#autocomplete").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: "https://www.googleapis.com/books/v1/volumes?",
        data: { 
          q: request.term,
          startIndex: 1,
          maxResults: 15
        },
        success: function (data) {
          data = data.items
          var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");
  
          console.log(data);
  
          var primary_matches = $.map(data, function (el) {
            let result = el.volumeInfo.title;
            if (matcher1.test(result)){
              return {
                value: result
              };
  
            }
              
          });
          var secondary_matches = $.map(data, function (el) {
            let result = el.volumeInfo.title;
            if (matcher2.test(result)){
              return {
                value: result
              };
  
            }
              
          });
          console.log(primary_matches);
          console.log(secondary_matches);
          response($.merge(primary_matches, secondary_matches));
        },
        // error: function () {
        //   response([]);
        // }
      });
    }
  })
  .data("ui-autocomplete")._renderItem = function( ul, item ) {
              return $( "<li>" )
              .attr( "data-value", item.value )
              .append( $( "<div>" ).html( item.label.replace(new RegExp(this.term, 'gi'),"<b>$&</b>") ) )
              .appendTo( ul );
          };