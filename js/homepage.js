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
  books = document.getElementsByClassName('each-book');
  for (x of books){
    chk.checked?x.classList.add("dark"):x.classList.remove("dark");
  }
  genre = document.getElementsByClassName('genre');
  for (x of genre){
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
    books = document.getElementsByClassName('each-book');
    for (x of books){
      x.classList.add("dark");
    }
    genre = document.getElementsByClassName('genre');
    for (x of genre){
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


// Search All Method
$("#all_autocomplete").autocomplete({
  appendTo: $('#all'),
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
      
      // error: function () {
      //   response([]);
      // }
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
          if (matcher1.test(result)){
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
          if (typeof img_link !== 'undefined'){
            img_link = el.volumeInfo.imageLinks.thumbnail;
          }
          else{
            img_link = '../images/no_image-removebg-preview.svg'
          }
          if (typeof authors == 'undefined'){
            authors = "AUTHOR UNKNOWN";
          }       
          if (matcher2.test(result)){
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
      
      // error: function () {
      //   response([]);
      // }
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

// Search by Author Method
// $("#author_autocomplete").autocomplete({
//   appendTo: $('#author'),
//   source: function (request, response) {
//     $.ajax({
//       url: "https://www.googleapis.com/books/v1/volumes?",
//       data: { 
//         q: "inauthor:" + request.term,
//         startIndex: 1,
//         maxResults: 15
//       },
//       success: function (data) {
//         data = data.items;
//         var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
//         var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");

//         console.log(data);

//         var primary_matches = $.map(data, function (el) {
//           let result = el.volumeInfo.authors;
//           console.log(result);
//           if (typeof result == 'undefined'){
//             result = "AUTHOR UNKNOWN";
//           }            
//           if (matcher1.test(result)){
//             return {
//               value: result
//             };

//           }
            
//         });
//         var secondary_matches = $.map(data, function (el) {
//           let authors = el.volumeInfo.authors;
//           if (typeof result == 'undefined'){
//             result = "AUTHOR UNKNOWN";
//           }       
//           if (matcher2.test(result)){
//             return {
//               value: result
//             };

//           }
            
//         });
//         console.log(primary_matches);
//         console.log(secondary_matches);
//         response($.merge(primary_matches, secondary_matches));
//       },
      
//       // error: function () {
//       //   response([]);
//       // }
//     });
//   }
// })
// .data("ui-autocomplete")._renderItem = function( ul, item ) {
//             var authorText = String(item.value).replace(
//               new RegExp(this.term, "gi"),
//               "<span class='ui-state-highlight'><b>$&</b></span>");

//             return $( "<li></li>" )
//             .attr( "data-value", item)
//             .append("<div><a>" + authorText + "</a></div>")
//             .appendTo( ul );
//         };


// Search by ISBN Method


// Autocomplete
$("#autocomplete").autocomplete({
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
        
        // error: function () {
        //   response([]);
        // }
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




