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

function gtags() {

    genres_set = genre_dataset.genres;

    for (genre_details of genres_set) {

        var genre = genre_details.genre;
        var desc = genre_details.description;

        console.log(genre, desc);
        document.getElementById('glist').innerHTML += `<button type="button" class="btn genre m-1">${genre}</button>`;
    }
}


function display_default() {
    call_api('romance');
}
display_default();

function call_api(genre) {
    var request = new XMLHttpRequest();
    var max = 10;

    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
    
            extract_display_data(this);

        }
    }

    var api_key = 'AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE';
    var url = `https://www.googleapis.com/books/v1/volumes?q=subject:${genre}&startIndex=0&maxResults=${max}&key=${api_key}`;

    request.open('GET', url, true);
    request.send();
}

function extract_display_data(xml) {
    var obj = JSON.parse(xml.responseText);
    var book_results = obj.items;
    var index = 0;

    for (book of book_results) {
        console.log(book);
        var book = book.volumeInfo;
        var index = 0;

        // book information
        var title = book.title;
        var author = book.authors;
        // var isbn = book.industryIdentifiers[0].identifier;
        var short_desc = book.description;
        var img = book.imageLinks.thumbnail;


        if ( typeof short_desc !== 'undefined' ) {
            if (short_desc.length > 150) {
                short_desc = short_desc.slice(0,150) + '...';
            }
        }
        else {
            short_desc = 'description not available';
        }

        
        
        console.log(img);
        // input each book
        var node = document.createElement('div');
        node.setAttribute('class', 'col-lg-3 col-sm-6 col-xs-6 mb-4');
        node.innerHTML = 
        `
        <img class="card-img-top" src="${img}" alt="..." width='42' height='185' >
        `;
        
        document.getElementById('main-content').appendChild(node);

        index += 1;

    }

}