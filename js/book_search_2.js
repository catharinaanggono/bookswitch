function extract_display_data(xml) {
    var obj = JSON.parse(xml.responseText);
    // console.log(xml.responseText);

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
                shortDesc = shortDesc.slice(0,300) + '...';
            }
        }
        else{
            shortDesc='';
        }

        // console.log(books_result[each_book]);
        // console.log(title);
        // console.log(author);
        // console.log(isbn);
        // console.log(shortDesc);
        // console.log(selfLink);
        // console.log(image);

        str += `
            <div class="col-lg-3 col-sm-6 col-xs-6 mb-4">
                <div class="card border-0 shadow">
                    <img class="card-img-top" src="" alt="..." width='225px' height='322px'>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">${title}</h5>
                        <div class="card-text text-black-50">${author}</div>
                        <p>${shortDesc}</p>
                    </div>
                </div>
            </div>`;

        document.getElementById('results').innerHTML += str;
        index += 1;
    }
}


function display_default() {
    call_api_test('harry potter', 0);
}

display_default();

function call_api_test(keyword, start_maybe){
    var request = new XMLHttpRequest();
    
    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
            extract_display_data(this);
            console.log('Inside call_api_test');
            var start_maybe = display_pagination_search(this, start, max);
            console.log(start_maybe);

        }
    }

    var page_num = 0;
    var max = 20;
    // var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
    start = page_num*max;

    var url=`https://www.googleapis.com/books/v1/volumes?q=harry%potter&startIndex=20&maxResults=${max}`;

    // if(category == 'all'){
    //     url = `https://www.googleapis.com/books/v1/volumes?q=${keyword}&maxResults=${max}&key=${key}`;
    // }
    // else{
    //     url = `https://www.googleapis.com/books/v1/volumes?q=${category}:${keyword}&maxResults=${max}&key=${key}`;
    // }

    request.open('GET', url, true);
    request.send();
}

// call_api_test('harry potter', 0);
// call_api_search();

function display_pagination_search(xml, start_maybe, max) {
    var obj = JSON.parse(xml.responseText);
    var keyword='harry potter';
    var total_items = obj.totalItems;
    // console.log(total_items);

    document.getElementById('pagination').innerHTML = ``;
    for(i = 0; i < max*5; i+=max){
        var page_num = Math.floor(i/max) + 1;
        var selected_id = `page${page_num+1}`;
        var node = document.createElement('li');
        node.setAttribute('class', 'page-item');
        node.innerHTML = 
        `
        <a id='page${page_num}' class="page-link" href="#${page_num}" onclick="call_api_test(${keyword}, ${page_num*max}); selected(${i});"> ${page_num} </a>
        `;
        document.getElementById('pagination').appendChild(node);
    }

    
    return page_num*max;
}

function selected(i) {
    // var obj = JSON.parse(xml.responseText);
    console.log(document.getElementById('pagination').innerHTML);
    var change = document.getElementsByTagName('href')[i].setAttribute('class', 'page-link selected-page');
    alert(selected_id);
}

function get_image(selfLink, index){
    // console.log(selfLink);
    var request = new XMLHttpRequest;
    var imageLink = '';
    
    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
            var obj = JSON.parse(request.responseText);
            var imageLink = obj.volumeInfo.imageLinks.thumbnail;
            // var small_img = obj.volumeInfo.imageLinks.small;

             // not all image has small size
            // if (small_img == undefined ) {
            //     imageLink = obj.volumeInfo.imageLinks.thumbnail;
            //     console.log(imageLink);
            // }
            // else{
            //     imageLink = obj.volumeInfo.imageLinks.small;
            // }
            
            document.getElementsByClassName('card-img-top')[index].setAttribute('src', imageLink);
            
        }
    }
    var url = selfLink;
    request.open('GET', url, true);
    request.send();
    return imageLink;
}