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
            "genre" : "Science Fiction",
            "description": "Science Fiction typically deals with imaginative and futuristic concepts such as advanced science and technology, time travel, extraterrestrial life, etc. The stories are often set in the future or on other planets."
            // "tags" : []
        }

    ]
};

function update_header(genre) {
    var genre_btns = document.getElementsByClassName('btn');

    for ( i = 0; i < genre_btns.length; i++ ) {
        genre_btns[i].setAttribute('class', 'btn genre m-1');
    }
    console.log(selected_genre);
    
}

function display_default() {
    call_api_genre('romance', 0);

}
display_default();

// search

// genre
function call_api_genre(genre, pg_num) {
    var request = new XMLHttpRequest();
    var max = 8;



    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
            document.getElementById('main-content').innerHTML = '';
            document.getElementById('pagination').innerHTML = '';
            
            extract_display_data(this);
            extract_page_data(this, genre, pg_num);
            console.log(`page num: ${pg_num}`);

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
            if (short_desc.length > 150) {
                short_desc = short_desc.slice(0,120) + '...';
            }
        }
        else {
            short_desc = 'description not available';
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
                <b>${title}</b><br>
                by ${author}
            </div>
        </div>
        <!-- style="visibility: hidden; -->
        <div class="each-desc" id="each-desc${index}" style="visibility: hidden;"> 
            <b>Description</b><br>
            ${short_desc}
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
}

function extract_page_data(xml, genre) {
    var obj = JSON.parse(xml.responseText);
    var book_results = obj.items;
    var index = 0;

    
    for ( i = 1; i <= 5; i++ ) {
        var node = document.createElement('button');
        node.setAttribute('class', 'btn genre m-1 text-blue');
        node.setAttribute('onclick', `call_api_genre('${genre}', ${i})`);
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

// function gtags() {

//     genres_set = genre_dataset.genres;

//     for (genre_details of genres_set) {

//         var genre = genre_details.genre;
//         var desc = genre_details.description;

//         // console.log(genre, desc);
//         document.getElementById('glist').innerHTML += `<button type="button" class="btn genre m-1" onclick='call_api(${genre})'>${genre}</button>`;
//     //    console.table( this.call_api(`${genre}`) );
//     }
// }