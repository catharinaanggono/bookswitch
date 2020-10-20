// 
function display_default() { //default
    call_api('a');
}

function show_books(selected_genre) { //romance, fantasy, horror
    call_api(selected_genre);
}

function call_api(selected_genre) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {

        if( this.readyState == 4 && this.status == 200 ) {
            //document.getElementById("api_call_result").innerHTML = this.responseText;
            extract_display_data(this); // This is called only after API returns a result
            //console.log(this.responseText);
        }

    }; // End-of-function

    var start_index = 1;
    var max_result = 40;
    var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
    var url = 'https://www.googleapis.com/books/v1/volumes?q=' + selected_genre + "&";

    var url = `https://www.googleapis.com/books/v1/volumes?q=${selected_genre}&startIndex=${start_index}&maxResults=${max_result}&key=${key}`;

    if( selected_genre == 'all' ) {
        selected_genre = "a"; // retrieve ALL heroes
    }


    console.log(url);

    request.open("GET", url, true);
    request.send();
}

function extract_display_data(xml) {
    //console.log(xml.responseText);
    var output = JSON.parse(xml.responseText);
    //console.log(output);

    var hero_cards_str = '';
    var total_items = output.totalItems;
    // console.log(total_items);
    var items = output.items;
    
    console.log(items);
    for ( i = 0; i < items.length; i++ ) {
        var volinfo = items[i].volumeInfo;
        // console.log(volumeinfo);
        var title = volinfo.title;
        var author = volinfo.authors;
        var description = volinfo.description;
        var published_date = volinfo.publishedDate;
        var img_url = volinfo.imageLinks.thumbnail;
        // console.log(img_url);

        var isbn_list = volinfo.industryIdentifiers;
        // console.table(isbn_list);

        //put inside url after clicking on book
        for ( isbn of isbn_list) {
            if ( isbn['type'] == 'ISBN_10') {
                var isbn10 = isbn['identifier'];
            }
            else if ( isbn['type'] == 'ISBN_13') {
                var isbn13 = isbn['identifier'];
            }
            else {
                var others = isbn['identifier'];
            }
        }
        // console.log(`isbn: ${isbn10} ${isbn13} ${others}`);

        var node = document.createElement('div');
        node.setAttribute('class', 'col-lg-3 col-sm-6 col-xs-6 mb-4');
        node.innerHTML = 
        `
        <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/TMgQMXoglsM/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
            <h5 class="card-title mb-0">Team Member</h5>
            <div class="card-text text-black-50">Web Developer</div>
        </div>
        </div>
        `;

        document.getElementById('main-content').appendChild(node);

    }



}

// // 
// function (display_book_details) {

// }

// // page 7
// function (my_books) {

// }

// // page 5
// function (reviews) {

// }