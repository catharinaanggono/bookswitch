// document.writeln('<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">');
// document.writeln('<script src="//code.jquery.com/jquery-1.12.4.js"></script>');
// document.writeln('<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>');

// var script = document.createElement('script'); 
 
// script.src = '//code.jquery.com/jquery-1.11.0.min.js'; 
// document.getElementsByTagName('head')[0].appendChild(script); 

// -----------------------------
// REAL CALL API FOR SEARCH RESULTS
// ------------------------------
// function call_api_search(keyword){
//     var request = new XMLHttpRequest();
    
//     request.onreadystatechange = function(){
//         if (request.readyState==4 && request.status==200){
//             extract_display_data(this);
            
//         }
//     }

//     var max = 20;
//     var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
//     var url='';

//     if(category == 'all'){
//         url = `https://www.googleapis.com/books/v1/volumes?q=${keyword}&maxResults=${max}&key=${key}`;
//     }
//     else{
//         url = `https://www.googleapis.com/books/v1/volumes?q=${category}:${keyword}&maxResults=${max}&key=${key}`;
//     }

//     request.open('GET', url, true);
//     request.send();
// }

// Show nav bar on scroll up, hide nav bar on scroll down
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("pagination").style.top = "0";
  } else {
    document.getElementById("pagination").style.top = "-100px";
  }
  prevScrollpos = currentScrollPos;
}

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
    var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
    start = page_num*max;

    var url=`https://www.googleapis.com/books/v1/volumes?q=harry%potter&key=${key}`;

    // if(category == 'all'){
    //     url = `https://www.googleapis.com/books/v1/volumes?q=${keyword}&maxResults=${max}&key=${key}`;
    // }
    // else{
    //     url = `https://www.googleapis.com/books/v1/volumes?q=${category}:${keyword}&maxResults=${max}&key=${key}`;
    // }

    request.open('GET', url, true);
    request.send();
}

call_api_test();
// call_api_search();

function display_pagination_search(xml, start_maybe, max) {
    var obj = JSON.parse(xml.responseText);
    var keyword='harry potter';
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
        <a id='page${page_num}' class="page-link" href="#${page_num}" onclick="call_api_test(${keyword}, ${page_num*max}); selected(${selected_id});"> ${page_num} </a>
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

// $("#search_book").autocomplete({
//     source: function (request, response) {
//         $.ajax({
//         url: "https://www.googleapis.com/books/v1/volumes?",
//         data: { 
//             q: request.term,
//             startIndex: 1,
//             maxResults: 15
//         },
//         success: function (data) {
//             data = data.items
//             var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
//             var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");

//             console.log(data);

//             var primary_matches = $.map(data, function (el) {
//             if (matcher1.test(el.volumeInfo.title)){
//                 return {
//                 value: el.volumeInfo.title
//                 };

//             }
                
//             });
//             var secondary_matches = $.map(data, function (el) {
//             if (matcher2.test(el.volumeInfo.title)){
//                 return {
//                 value: el.volumeInfo.title
//                 };

//             }
                
//             });
//             console.log(primary_matches);
//             console.log(secondary_matches);
//             response($.merge(primary_matches, secondary_matches));

//             // response($.map($.merge(primary_matches, secondary_matches), function(item){
//             //     return {label: __highlight(item.title, request.term) + "(" + item.type + ")", value: item.title}
//             // }));
//         },

//         });
//     }}).data("ui-autocomplete")._renderItem = function( ul, item ) {
//     return $( "<li>" )
//     .attr( "data-value", item.value )
//     .append( $( "<div>" ).html( item.label.replace(new RegExp(this.term, 'gi'),"<b>$&</b>") ) )
//     .appendTo( ul );
//     };


// window.addEventListener("load", function(){

//     // Add a keyup event listener to our input element
//     var name_input = document.getElementById('name_input');
//     name_input.addEventListener("keyup", function(event){hinter(event)});

//     // create one global XHR object 
//     // so we can abort old requests when a new one is make
//     window.hinterXHR = new XMLHttpRequest();
// });

// // Autocomplete for form
// function hinter(event) {

//     // retireve the input element
//     var input = event.target;

//     // retrieve the datalist element
//     var huge_list = document.getElementById('huge_list');

//     // minimum number of characters before we start to generate suggestions
//     var min_characters = 0;

//     if (input.value.length < min_characters ) { 
//         return;
//     } else { 

//         // abort any pending requests
//         window.hinterXHR.abort();

//         window.hinterXHR.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {

//                 // We're expecting a json response so we convert it to an object
//                 var response = JSON.parse( this.responseText ); 

//                 // clear any previously loaded options in the datalist
//                 huge_list.innerHTML = "";

//                 response.forEach(function(item) {
//                     // Create a new <option> element.
//                     var option = document.createElement('option');
//                     option.value = item;

//                     // attach the option to the datalist element
//                     huge_list.appendChild(option);
//                 });
//             }
//         };

//         window.hinterXHR.open("GET", "/query.php?query=" + input.value, true);
//         window.hinterXHR.send()
//     }
// }