// BookSwitch focuses on fiction books
// https://gladreaders.com/types-or-genres-of-books/ + https://www.writerswrite.co.za/the-17-most-popular-genres-in-fiction-and-why-they-matter/
const genre_dataset = {

    "genres" : [
      { 
        "genre" : "Adventure",
        "description": "Science Fiction typically deals with imaginative and futuristic concepts such as advanced science and technology, time travel, extraterrestrial life, etc. The stories are often set in the future or on other planets."
        // "tags" : []
      },
      { 
        "genre" : "Children",
        "description": "This genre of book is characterized and defined by the moods they evoke among the readers, giving them heightened feelings of suspense, excitement, thrill, surprise, anticipation, and anxiety. Literary devices such as plot twists and cliffhangers are extensively used in this genre."
        // "tags" : ["crime thriller", "action thriller", "mystery thriller", "science fiction thriller"]
      },
      { 
        "genre" : "Fantasy",
        "description": "A Book under this genre contains a story set in a fantasy world – a world that is not real and often includes magic, magical creatures, and supernatural events."
        // "tags" : ["superhero", "fairytale", "fables", "magic"]
      },
      { 
        "genre" : "Mystery",
        "description": "Mystery books have a suspenseful plot that often involves a mysterious crime. Suspects and motives are considered and clues throughout the story lead to a solution to the problem."
        // "tags" : ["police procedural", "detective"]
      },
      {
        "genre" : "Romance",
        "description": "The primary focus of romance fiction is on the relationship and romantic love between two people. These books have an emotionally satisfying and optimistic ending."
        // "tags" : ["contemporary romance", "historical romance", "inspirational romance"]
      }
    ]
};

function update_header(id) {
  for (genre of genre_dataset.genres) {
    document.getElementById(`${genre.genre}`).setAttribute('style', '');
    if (genre.genre == id){
      document.getElementById('gtitle').innerText = id;
      document.getElementById('gdesc').innerText = genre.description;
    }

    if (genre.genre == id) {  
      if(localStorage.getItem('darkModeStatus')=="true"){
        document.getElementById(`${id}`).setAttribute("style", ""); 
        document.getElementById(`${id}`).setAttribute("style", "border: 2px solid #267055; color:  #267055;"); 
      } else {
        document.getElementById(`${id}`).setAttribute("style", ""); 
        document.getElementById(`${id}`).setAttribute("style", "border: 2px solid #A94241; color:  #A94241;");
      }
    }     
  }
}

function display_default() {
    call_api_genre('Adventure', 0);
    show_page_button('Adventure', 0);
    update_header('Adventure');
}

display_default();

chk.addEventListener('click', () => {
  for (genre of genre_dataset.genres) {
    const element = document.getElementById(`${genre.genre}`);
    const style = getComputedStyle(element);

    if ( (style.color == 'rgb(38, 112, 85)') || (style.color == 'rgb(169, 66, 65)') ) {
      console.log(style.color);
      console.log(style.color == 'rgb(38, 112, 85)');
      console.log(style.color == 'rgb(169, 66, 65)');
    }

    if (style.color == 'rgb(38, 112, 85)') { //green
      console.log('change from g to r');
      document.getElementById(`${genre.genre}`).setAttribute("style", "border: 2px solid #A94241; color:  #A94241;"); 
    }

    else if (style.color == 'rgb(169, 66, 65)'){
      console.log('change from r to g');
      document.getElementById(`${genre.genre}`).setAttribute("style", "border: 2px solid #267055; color:  #267055;"); 
    }
  }
});

// pagination
function show_page_button(genre, first_start) {
  for ( i = 1; i <= 5; i++ ) {
    var node = document.createElement('button');
    node.setAttribute('class', 'btn m-1');
    node.setAttribute('id', `page${i}`);
    node.setAttribute('onclick', `call_api_genre('${genre}', ${i})`);
    node.innerHTML = `${i}`;
    document.getElementById('pagination').appendChild(node);
    document.getElementById(`page1`).setAttribute('style', 'background-color: #A94241');
  }
}

// genre
function call_api_genre(genre, pg_num) {
    var request = new XMLHttpRequest();
    var max = 30;

    request.onreadystatechange = function(){
      if (request.readyState==4 && request.status==200){
        document.getElementById('main-content').innerHTML = '';
        document.getElementById(`page1`).setAttribute('style', 'background-color: #A94241');
        
        // set pg1 as active
        pages = document.getElementById('pagination').getElementsByTagName('button');
        for (let i = 0; i < pages.length; i++){
          if (i+1 == pg_num){
            pages[i].setAttribute('class', 'btn m-1 active');
            document.getElementById(`page1`).setAttribute('style', '');
          }
          else{
            pages[i].setAttribute('class', 'btn m-1');
          }
        }
        extract_display_data(this);
      }
    }

    var start_index = pg_num*max;
    var url = `https://www.googleapis.com/books/v1/volumes?q=subject:${genre}&startIndex=${start_index}&maxResults=${max}`;
    request.open('GET', url, true);
    request.send();
}

function extract_display_data(xml) {
  var obj = JSON.parse(xml.responseText);
  var book_results = obj.items;
  var index = 0;

  for (book of book_results) {
    var book = book.volumeInfo;

    // book information
    var title = book.title;
    var author = book.authors;
    var isbn = book.industryIdentifiers[0].identifier;
    var short_desc = book.description;
    var img = book.imageLinks.thumbnail;

    if ( typeof short_desc !== 'undefined' ) {
      short_desc = short_desc;
    }
    else {
      short_desc = 'Description not available';
    }

    if (typeof isbn !== 'undefined'){
      isbn = book.industryIdentifiers[0].identifier;
    }
    else{
      isbn = '';
    }

    // input each book
    var node = document.createElement('div');
    node.setAttribute('class', ' base col-lg-4 col-6 col-sm-6 col-md-6 my-2');
    node.setAttribute('onmouseout', `hide_desc('each-desc${index}')`);
    node.setAttribute('onmouseover', `show_desc('each-desc${index}')`);
    node.setAttribute('onclick', `redirect(${isbn})`);
    node.innerHTML = 
    `
    <div class="each-book">
    <div class="each-img"><img src="${img}" width="100%" height="100%" style="border-radius: 2%;"></div>
    <div class="main-details" style='overflow: hidden;'>
        <span id ='title' style='font-size:15px;'><b><a class='title_link ' href='bookdetails.php?isbn=${isbn}'>${title}</a></b></span><br>
        
        <span style='font-size:13px; overflow: hidden;'>by ${author}</span>
    </div>
    </div>
    <!-- style="visibility: hidden; -->
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

function redirect(isbn) {
  location.href = `bookdetails.php?isbn=${isbn}`;
  document.getElementById('title').getElementsByTagName('a')[0].setAttribute('href', `bookdetails.php?isbn=${isbn}`);
}

function extract_page_data(xml, genre) {
  var obj = JSON.parse(xml.responseText);
  var book_results = obj.items;
  var index = 0;
  
  for ( i = 1; i <= 5; i++ ) {
    var node = document.createElement('button');
    node.setAttribute('class', 'btn page m-1');
    node.setAttribute('id', `page${i}`);
    node.setAttribute('onclick', `call_api_genre('${genre}', ${i});`);
    node.innerHTML = `${i}`;
    document.getElementById('pagination').appendChild(node);
  }
}

function show_desc(id) {
  var node = document.getElementById(id);
  node.setAttribute('style', 'visibility: visible;');
}

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

document.getElementById("my_autocomplete").onkeypress = function(event){
  if (event.keycode == 13 || event.which == 13){
    var query = document.getElementById("my_autocomplete").value;
    var category = 'all';
    redirect_to_book_search_personal(query, category);
  }
};

function redirect_to_book_search_personal(query, category){
  location.href = `book_search.php?query=${query}&category=${category}`;
}