// Get the value of query and category passed from homepage
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const query = urlParams.get('query');
const category = urlParams.get('category');
var first_start = 1;

// call this when load 
first_load(category, query, first_start);

// function for first load of the page
function first_load(category, query, first_start){
  call_api_search(category, query, first_start);
  show_page_button(category, query, first_start);
}

// to display the books
function extract_display_data(xml) {
    var obj = JSON.parse(xml.responseText);
    var books_result = obj.items;
    var index = 0;

    for (each_book in books_result){
        var title = books_result[each_book].volumeInfo.title;
        var author = books_result[each_book].volumeInfo.authors;
        var isbn = books_result[each_book].volumeInfo.industryIdentifiers;
        var short_desc = books_result[each_book].volumeInfo.description;
        var img = books_result[each_book].volumeInfo.imageLinks;

        if (typeof short_desc !== 'undefined'){
            short_desc = short_desc;
        }
        else{
            short_desc='Description not available';
        }

        if (typeof isbn !== 'undefined'){
            isbn = books_result[each_book].volumeInfo.industryIdentifiers[0].identifier;
        }
        else{
            isbn = '';
        }

        if (typeof img !== 'undefined'){
            img = books_result[each_book].volumeInfo.imageLinks.thumbnail;
        }
        else{
            img = '../images/no_image-removebg-preview.svg'
        }

        var node = document.createElement('div');
        node.setAttribute('class', ' base col-lg-4 col-md-4 col-sm-6 col-6');
        node.setAttribute('onmouseout', `hide_desc('each-desc${index}')`);
        node.setAttribute('onmouseover', `show_desc('each-desc${index}')`);
        node.setAttribute('onclick', `redirect('${isbn}')`);
        node.innerHTML = 
        `
        <div class="each-book">
            <div class="each-img"><img src="${img}" width="100%" height="100%" style="border-radius: 2%;"></div>
            <div class="main-details" style='overflow: hidden;'>
                <span id ='title' style='font-size:15px;'><b><a class='title_link' href='bookdetails.php?isbn=${isbn}'>${title}</a></b></span><br>
                
                <span style='font-size:13px; overflow: hidden;'>by ${author}</span>
            </div>
        </div>
        <div class="each-desc" id="each-desc${index}" style='visibility: hidden; text-overflow: ellipsis; '> 
            <div>
                <b>Description</b><br>
                <span style='display: flex; height: 100px; overflow: hidden; text-overflow: ellipsis;'> ${short_desc}</span>
            </div>
        </div>
        `;
        document.getElementById('main-content').appendChild(node);
        index += 1;
    }
}

// to redirect to book details page
function redirect(isbn){
    location.href = `bookdetails.php?isbn=${isbn}`;
    console.log('HI');
    document.getElementById('title').getElementsByTagName('a')[0].setAttribute('href', `bookdetails.php?isbn=${isbn}`);
}

// to call api
function call_api_search(category, keyword, pg_num){
    var request = new XMLHttpRequest();
    var max = 30;
    request.onreadystatechange = function(){
      if (request.readyState==4 && request.status==200){
        document.getElementById('main-content').innerHTML = '';
        pages = document.getElementById('pagination').getElementsByTagName('button');
        for (let i = 0; i < pages.length; i++){
          if (i+1 == pg_num){
            pages[i].setAttribute('class', 'btn m-1 active');
          }
          else{
            pages[i].setAttribute('class', 'btn m-1');
          }
        }
        extract_display_data(this);
      }
    }
    var start_index = (pg_num-1)*max;
    if(category == 'all'){
      url = `https://www.googleapis.com/books/v1/volumes?q=${keyword}&startIndex=${start_index}&maxResults=${max}`;
      console.log(url);
    }
    else{
      url = `https://www.googleapis.com/books/v1/volumes?q=${category}:${keyword}&startIndex=${start_index}&maxResults=${max}`;
      console.log(url);
    }
    request.open('GET', url, true);
    request.send();
}

// to display pagination button
function show_page_button(category, query, first_start) {
  for ( i = 1; i <= 5; i++ ) {
    var node = document.createElement('button');
    node.setAttribute('class', 'btn m-1');
    node.setAttribute('id', `page${i}`);
    node.setAttribute('onclick', `call_api_search('${category}', '${query}', ${i})`);
    node.innerHTML = `${i}`;
    document.getElementById('pagination').appendChild(node);
  }
}

// to show the book description box
function show_desc(id) {
    var node = document.getElementById(id);
    node.setAttribute('style', 'visibility: visible;');
}

// to hide the book description box
function hide_desc(id) {
    var node = document.getElementById(id);
    node.setAttribute('style', 'visibility: hidden;');
}

// Autocomplete
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

// to show footer when the page is ready and also 1 sec delay
$(document).ready(function(){
  $('footer').css({'opacity': 0});
});

$(window).load(function(){
  setTimeout(function () {
    $('footer').css({'opacity': 1});
  }, 1000);
});
