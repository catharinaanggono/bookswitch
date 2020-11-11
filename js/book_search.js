// Get the value of query and category passed from homepage
// var category = decodeURI(getUrlParam('&category', 'empty'));
// var query = decodeURI(getUrlParam('?query', 'empty'));
// var first_start = 0;
// alert(`category  = ${category} query = ${query}  firstStart=${first_start}`);

// function getUrlParam(parameter, defaultvalue){
//     var urlparameter = defaultvalue;
//     if(location.href.indexOf(parameter) > -1){
//         urlparameter = getUrlVars()[parameter];
//         // console.log(getUrlVars()[parameter]);
//         }
//     return urlparameter;
// }

// function getUrlVars() {
//     var vars = {};
//     var parts = location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key,value) {
//         vars[key] = value;
//     });
//     // console.log(parts);
//     // console.log(vars);
//     return vars;
// }

const queryString = window.location.search;
console.log(queryString);
const urlParams = new URLSearchParams(queryString);
console.log(urlParams);
const query = urlParams.get('query');
console.log(page_type);
console.log('HI');
const category = urlParams.get('category');
console.log(category);

// call_api_search('all', 'harry potter', 0);
call_api_search(category, query, first_start);

function extract_display_data(xml) {
    var obj = JSON.parse(xml.responseText);
    // console.log(xml.responseText);

    var books_result = obj.items;
    var index = 0;

    // console.log(books_result);
    // console.log(document.getElementById('results'));
    for (each_book in books_result){
        // console.log(each_book);
        // console.log(books_result[each_book].saleInfo.saleability);
        var str = '';
        var title = books_result[each_book].volumeInfo.title;
        var author = books_result[each_book].volumeInfo.authors;
        var isbn = books_result[each_book].volumeInfo.industryIdentifiers;
        var short_desc = books_result[each_book].volumeInfo.description;
        var selfLink = books_result[each_book].selfLink;
        var img = books_result[each_book].volumeInfo.imageLinks;

        if (typeof short_desc !== 'undefined'){
            if(short_desc.length > 230){
                short_desc = short_desc.slice(0,230) + '...';
            }
        }
        else{
            short_desc='description not available';
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

        // console.log(books_result[each_book]);
        // console.log(title);
        // console.log(author);
        // console.log(isbn);
        // console.log(shortDesc);
        // console.log(selfLink);
        // console.log(image);

        var node = document.createElement('div');
        node.setAttribute('class', ' base col-lg-4 col-md-4 col-sm-6 col-6');
        node.setAttribute('onmouseout', `hide_desc('each-desc${index}')`);
        node.setAttribute('onmouseover', `show_desc('each-desc${index}')`);
        node.setAttribute('onclick', `redirect('${isbn}')`);
        node.innerHTML = 
        `
        <div class="each-book shadow rounded">
            <div class="each-img"><img src="${img}" width="100%" height="100%" style="border-radius: 2%;"></div>
            <div class="main-details">
                <span id ='title' style='font-size:15px;'><a href=''><b>${title}</b></a></span><br>
                <span style='font-size:13px;'>by ${author}</span>
            </div>
        </div>
        <!-- style="visibility: hidden; -->
        <div class="each-desc shadow rounded" id="each-desc${index}" style="visibility: hidden;"> 
            <b>Description</b><br>
            <span style='font-size:15px;'>${short_desc}</span>
        </div>
        `;
        document.getElementById('main-content').appendChild(node);
        // console.log(node);
        // console.log(document.getElementById('main-content'));
        index += 1;
        console.log(index);
    }
}

// to redirect to book details page
function redirect(isbn){
    location.href = `bookdetails.php?isbn=${isbn}`;
    document.getElementById('title').getElementsByTagName('a')[0].setAttribute('href', `bookdetails.php?isbn=${isbn}`);
}

function call_api_search(category, keyword, pg_num){
    var request = new XMLHttpRequest();
    var max = 30;

    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
            document.getElementById('main-content').innerHTML = '';
            document.getElementById('pagination').innerHTML = '';
            
            extract_display_data(this);
            extract_page_data(this, pg_num, max);
            console.log(`page num: ${pg_num}`);

        }
    }

    var start_index = pg_num*max;
    console.log(start_index);

    // var url=`https://www.googleapis.com/books/v1/volumes?q=${keyword}&startIndex=${start_index}&maxResults=${max}`;

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

function extract_page_data(xml, pg_num, max) {
    var obj = JSON.parse(xml.responseText);
    var book_results = obj.items;
    var index = 0;
    // var total_items = obj.totalItems;
    // var num_of_pages = Math.ceil(total_items / max);
    // console.log(total_items);
    // console.log(num_of_pages);
    
    for ( i = 1; i <= 5; i++ ) {
        var node = document.createElement('button');
        node.setAttribute('class', 'btn genre m-1');
        node.setAttribute('onclick', `call_api_search('all', 'harry potter', ${i}); reset_button(${i}); select_button(${i})`);
        node.innerHTML = `${i}`;
        
        // console.log(node);
        document.getElementById('pagination').appendChild(node);
    }

}

function reset_button(i){
    // var buttons = document.getElementsByTagName('button');
    // for (index = 1; index < buttons.length; index++){
    // //     if (index == i){
    // //         buttons[index].setAttribute('class', 'btn genre m-1 active');
    // //     }
    // //     else{
    //         buttons[index].setAttribute('class', 'btn genre m-1');
    //     // }
    //     // console.log(i);
    //     // console.log(buttons[i]);
    // }
}

function select_button(i){
    // var index = i - 1
    // var buttons = document.getElementsByTagName('button');
    // buttons[index].setAttribute('class', 'btn genre m-1 active');
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

