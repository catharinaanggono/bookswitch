// BookSwitch focuses on fiction books
// https://gladreaders.com/types-or-genres-of-books/ + https://www.writerswrite.co.za/the-17-most-popular-genres-in-fiction-and-why-they-matter/
const genre_dataset = {

    "genres" : [
        { 
            "genre" : "Mystery",
            "description": "Mystery books have a suspenseful plot that often involves a mysterious crime. Suspects and motives are considered and clues throughout the story lead to a solution to the problem."
            // "tags" : ["police procedural", "detective"]
        },
        {
            "genre" : "Romance",
            "description": "The primary focus of romance fiction is on the relationship and romantic love between two people. These books have an emotionally satisfying and optimistic ending."
            // "tags" : ["contemporary romance", "historical romance", "inspirational romance"]
        },
        { 
            "genre" : "Thriller",
            "description": "This genre of book is characterized and defined by the moods they evoke among the readers, giving them heightened feelings of suspense, excitement, thrill, surprise, anticipation, and anxiety. Literary devices such as plot twists and cliffhangers are extensively used in this genre."
            // "tags" : ["crime thriller", "action thriller", "mystery thriller", "science fiction thriller"]
        },
        { 
            "genre" : "Fantasy",
            "description": "A Book under this genre contains a story set in a fantasy world – a world that is not real and often includes magic, magical creatures, and supernatural events."
            // "tags" : ["superhero", "fairytale", "fables", "magic"]
        },
        { 
            "genre" : "Adventure",
            "description": "Science Fiction typically deals with imaginative and futuristic concepts such as advanced science and technology, time travel, extraterrestrial life, etc. The stories are often set in the future or on other planets."
            // "tags" : []
        }

    ]
};

function update_header(id) {


    for (genre of genre_dataset.genres) {
        // console.log(genre.genre);
        document.getElementById(`${genre.genre}`).setAttribute('style', '');
        if (genre.genre == id){
            document.getElementById('gtitle').innerText = id;
            document.getElementById('gdesc').innerText = genre.description;
        }
    

        if (genre.genre == id) {  
            console.log(id);
            document.getElementById(`${id}`).setAttribute('style', 'border: 2px solid #267055; color:  #267055; ');
        }   
            
    }
    
}


function display_default() {
    call_api_genre('Mystery', 0);
}
display_default();



// genre
function call_api_genre(genre, pg_num) {
    var request = new XMLHttpRequest();
    var max = 30;

    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
            document.getElementById('main-content').innerHTML = '';
            document.getElementById('pagination').innerHTML = '';

            
            extract_display_data(this);
            extract_page_data(this, genre, pg_num);
            console.log(`page num: ${pg_num}`);

            document.getElementById(`page${pg_num}`).setAttribute('style', 'background-color: #A94241;');
            // for (i = 0; i <= 5; i++) {
            //     document.getElementById(`page${i}`).setAttribute('style', '');
            // }
            
        }
    }

    // var api_key = 'AIzaSyD3eModiXQP1JF-YgUIpOQ9TjmwQ9NQ3q8';
    // &key=${api_key}
    var start_index = pg_num*max;
    console.log(start_index);
    var url = `https://www.googleapis.com/books/v1/volumes?q=subject:${genre}&startIndex=${start_index}&maxResults=${max}`;

    request.open('GET', url, true);
    request.send();
}



function extract_display_data(xml) {
    var obj = JSON.parse(xml.responseText);
    var book_results = obj.items;
    var index = 0;

    for (book of book_results) {
        // console.log(index);
        // console.log(book);
        var book = book.volumeInfo;

        // book information
        var title = book.title;
        var author = book.authors;
        var isbn = book.industryIdentifiers[0].identifier;
        var short_desc = book.description;
        var img = book.imageLinks.thumbnail;
        // console.log(isbn);

        if ( typeof short_desc !== 'undefined' ) {
            // if (short_desc.length > 150) {
            //     short_desc = short_desc.slice(0,120) + '...';
            // }
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

        
        // console.log(img);
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
            <div class="main-details">
                <span id ='title' style='font-size:15px;'><a href=''>${title}</a></span><br>
                <span style='font-size:13px;'>by ${author}</span>
            </div>
        </div>
        <!-- style="visibility: hidden; -->
        <div class="each-desc" id="each-desc${index}" style='visibility: hidden; '> 
            <div>
                <b>Description</b><br>
                <span style='display: flex; height: 100px; overflow: hidden;'> ${short_desc}</span>
            </div>
        </div>

        `;
        
        document.getElementById('main-content').appendChild(node);
        // console.log(node);
        // console.log(document.getElementById('main-content'));
        index += 1;

        
    }
    // console.log(document.getElementsByClassName('hehe')[0].innerHTML);


}

function redirect(isbn) {
    location.href = `bookdetails.php?isbn=${isbn}`;
    console.log(index);
    document.getElementById('title').getElementsByTagName('a')[0].setAttribute('href', `bookdetails.php?isbn=${isbn}`);
    console.log();
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
        
        // console.log(node);
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

document.getElementById("autocomplete").onkeypress = function(event){
  if (event.keycode == 13 || event.which == 13){
    var query = document.getElementById("autocomplete").value;
    var category = 'all';
    redirect_to_book_search(query, category);
  }
};