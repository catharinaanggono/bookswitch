// genre description
const genre_dataset = [

    {"Fantasy": "Fantasy is a genre that uses magic and other supernatural forms as a primary element of plot, theme, and/or setting. Fantasy is generally distinguished from science fiction and horror by the expectation that it steers clear of technological and macabre themes, respectively, though there is a great deal of overlap between the three (collectively known as speculative fiction or science fiction/fantasy) In its broadest sense, fantasy comprises works by many writers, artists, filmmakers, and musicians, from ancient myths and legends to many recent works embraced by a wide audience today, including young adults, most of whom are represented by the works below."},

    {"Romance": "According to the Romance Writers of America, 'Two basic elements comprise every romance novel: a central love story and an emotionally-satisfying and optimistic ending.' Both the conflict and the climax of the novel should be directly related to that core theme of developing a romantic relationship, although the novel can also contain subplots that do not specifically relate to the main characters' romantic love. Other definitions of a romance novel may be broader, including other plots and endings or more than two people, or narrower, restricting the types of romances or conflicts."},

    {"Horror": "Horror fiction is fiction in any medium intended to scare, unsettle, or horrify the audience. Historically, the cause of the 'horror' experience has often been the intrusion of a supernatural element into everyday human experience. Since the 1960s, any work of fiction with a morbid, gruesome, surreal, or exceptionally suspenseful or frightening theme has come to be called 'horror'. Horror fiction often overlaps science fiction or fantasy, all three of which categories are sometimes placed under the umbrella classification speculative fiction."}

];

function display_default() {
    call_api('romance', 0);
}

display_default();

function call_api(genre, start_maybe){
    var request = new XMLHttpRequest();

    var max = 28;
    var page_num = 0;

    // var genre_header = document.getElementById('genre-header').innerText = `${genre}`;
    // var desc_dataset = genre_dataset['fantasy'];
    // alert(desc_dataset);


    
    
    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
            
            extract_display_data(this);

            var click = 0;
            var start_maybe = display_pagination(this, start, max, genre);
            // console.log(start_maybe);
            
        }
    }

    var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
    
    start = page_num*max;
    
    var url = `https://www.googleapis.com/books/v1/volumes?q=subject:${genre}&startIndex=${start_maybe}&maxResults=${max}&key=${key}`;

    console.log(url);

    request.open('GET', url, true);
    request.send();
}

function extract_display_data(xml) {

    // console.log(request.responseText);
    var obj = JSON.parse(xml.responseText);

    var books_result = obj.items;

    var index = 0;

    // console.log(books_result);
    // console.log(document.getElementById('results'));
    for (each_book in books_result){
        var str = '';
        var title = books_result[each_book].volumeInfo.title;
        var author = books_result[each_book].volumeInfo.authors;
        var isbn = books_result[each_book].volumeInfo.industryIdentifiers[0].identifier;
        var shortDesc = books_result[each_book].volumeInfo.description;
        var selfLink = books_result[each_book].selfLink;
        var image = get_image(selfLink, index);

        if (typeof shortDesc !== 'undefined'){
            if(shortDesc.length > 300){
                shortDesc = shortDesc.slice(0,3) + '...';
            }
        }
        else{
            shortDesc='';
        }

        // console.log(books_result[each_book]);
        // console.log(title);
        // console.log(isbn);
        // console.log(shortDesc);
        // console.log(selfLink);
        // console.log(image);

        // each book
        var node = document.createElement('div');
        node.setAttribute('class', 'col-lg-3 col-sm-6 col-xs-6 mb-4');
        node.innerHTML = 
        `
        <div class="card border-0 shadow">
        <img class="card-img-top" src="" alt="..." width='225px' height='322px'>
        <div class="card-body text-center">
            <h5 class="card-title mb-0">${title}</h5>
            <div class="card-text text-black-50">${author}</div>
            <p>${shortDesc}</p>
        </div>
        </div>
        `;
        document.getElementById('main-content').appendChild(node);

        index += 1;
    }

}

function display_pagination(xml, start_maybe, max, genre) {
    var obj = JSON.parse(xml.responseText);

    var total_items = obj.totalItems;
    // console.log(total_items);

    document.getElementById('pagination').innerHTML = ``;
    for(i = 0; i < max*10; i+=max){

        var selected_id = `page${page_num+1}`;
        var page_num = Math.floor(i/max) + 1;
        var node = document.createElement('li');
        node.setAttribute('class', 'page-item');
        node.innerHTML = 
        `
        <a id='page${page_num}' class="page-link" href="#${page_num}" onclick="call_api('${genre}', ${page_num*max}); selected(${selected_id});"> ${page_num} </a>
        `;
        document.getElementById('pagination').appendChild(node);
    }

    
    return page_num*max;
}

function selected(selected_id) {
    // var obj = JSON.parse(xml.responseText);
    console.log(document.getElementById('pagination').innerHTML);
    var change = document.getElementsByTagName('href')[selected_id].setAttribute('class', 'page-link selected-page');
    alert(selected_id);
}


function get_image(selfLink, index){
    // console.log(selfLink);
    var request = new XMLHttpRequest;
    var imageLink = '';
    
    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){

            var obj = JSON.parse(request.responseText);
            var small_img = obj.volumeInfo.imageLinks.small;
            
            // not all image has small size
            if (small_img == undefined ) {
                imageLink = obj.volumeInfo.imageLinks.thumbnail;
                // console.log(imageLink);
            }
            else{
                imageLink = obj.volumeInfo.imageLinks.small;
            }
            
            document.getElementsByClassName('card-img-top')[index].setAttribute('src', imageLink);
            // console.log(imageLink);

        }
    }

    var url = selfLink;
    request.open('GET', url, true);
    request.send();

    return imageLink;
}