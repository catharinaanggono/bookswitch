// -----------------------------
// REAL CALL API FOR SEARCH RESULTS
// ------------------------------
// function call_api_search(keyword){
//     var request = new XMLHttpRequest();
    
//     request.onreadystatechange = function(){
//         if (request.readyState==4 && request.status==200){
//             extract_display_data(this);
            
//         }
//     };

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

function extract_display_data(xml) {
    var obj = JSON.parse(xml.responseText);
    // console.log(xml.responseText);

    var books_result = obj.items;
    var index = 0;

    console.log(books_result);
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
            if(short_desc.length > 250){
                short_desc = short_desc.slice(0,250) + '...';
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

        // console.log(books_result[each_book]);
        // console.log(title);
        // console.log(author);
        // console.log(isbn);
        // console.log(shortDesc);
        // console.log(selfLink);
        // console.log(image);

        var node = document.createElement('div');
        node.setAttribute('class', ' base');
        node.setAttribute('onmouseout', `hide_desc('each-desc${index}')`);
        node.setAttribute('onmouseover', `show_desc('each-desc${index}')`);
        node.innerHTML = 
        `
        <div class="each-book">
            <div class="each-img"><img src="${img}" width="100%" height="100%" style="border-radius: 2%;"></div>
            <div class="main-details">
                <span style='font-size:12px;'><b>${title}</b></span><br>
                <span style='font-size:10px;'>by ${author}</span>
            </div>
        </div>
        <!-- style="visibility: hidden; -->
        <div class="each-desc" id="each-desc${index}" style="visibility: hidden;"> 
            ${short_desc}
        </div>
        `;
        
        document.getElementById('main-content').appendChild(node);
        // console.log(node);
        // console.log(document.getElementById('main-content'));
        index += 1;
    }
}


function call_api_test(keyword, pg_num){
    var request = new XMLHttpRequest();
    var max = 39;

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

    var url=`https://www.googleapis.com/books/v1/volumes?q=harry%potter&startIndex=${start_index}&maxResults=${max}`;

    // if(category == 'all'){
    //     url = `https://www.googleapis.com/books/v1/volumes?q=${keyword}&maxResults=${max}&key=${key}`;
    // }
    // else{
    //     url = `https://www.googleapis.com/books/v1/volumes?q=${category}:${keyword}&maxResults=${max}&key=${key}`;
    // }

    request.open('GET', url, true);
    request.send();
}

call_api_test('harry potter', 1);
// call_api_search();


function extract_page_data(xml, pg_num, max) {
    var obj = JSON.parse(xml.responseText);
    var book_results = obj.items;
    var index = 0;
    var total_items = obj.totalItems;
    var num_of_pages = Math.ceil(total_items / max);
    console.log(total_items);
    console.log(num_of_pages);
    
    for ( i = 1; i <= 5; i++ ) {
        var node = document.createElement('button');
        node.setAttribute('class', 'btn genre m-1 text-blue');
        node.setAttribute('onclick', `call_api_test('harry potter', ${i})`);
        node.innerHTML = `${i}`;
        
        // console.log(node);
        document.getElementById('pagination').appendChild(node);
    }
    
    // for (book of book_results) {

    // }

}

function show_desc(id) {
    var node = document.getElementById(id);
    node.setAttribute('style', 'visibility: visible;');
}

function hide_desc(id) {
    var node = document.getElementById(id);
    node.setAttribute('style', 'visibility: hidden;');
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