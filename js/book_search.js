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

// Get the value of query and category passed from homepage
const queryString = window.location.search;
// console.log(queryString);
const urlParams = new URLSearchParams(queryString);
// console.log(urlParams);
const query = urlParams.get('query');
// console.log(query);
// console.log('HI');
const category = urlParams.get('category');
// console.log(category);
var first_start = 1;

show_page_button(category, query, first_start);
first_load();

function first_load(){
  // call_api_search('all', 'harry potter', 1);
  call_api_search(category, query, first_start);
}

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
        <div class="each-book">
            <div class="each-img"><img src="${img}" width="100%" height="100%" style="border-radius: 2%;"></div>
            <div class="main-details" style='overflow: hidden;'>
                <span id ='title' style='font-size:15px;'><b><a href=''>${title}</a></b></span><br>
                
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
        // console.log(node);
        // console.log(document.getElementById('main-content'));
        index += 1;
        // console.log(index);
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
            // document.getElementById('pagination').innerHTML = '';
            pages = document.getElementById('pagination').getElementsByTagName('button');
            for (let i = 0; i < pages.length; i++){
              console.log(pages[i]);
              if (i+1 == pg_num){
                pages[i].setAttribute('class', 'btn m-1 active');
              }
              else{
                pages[i].setAttribute('class', 'btn m-1');
              }
            }
            console.log(pages);
            extract_display_data(this);
            console.log(`page num: ${pg_num}`);

        }
    }

    var start_index = (pg_num-1)*max;
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

function show_page_button(category, query, first_start) {
  for ( i = 1; i <= 5; i++ ) {
      var node = document.createElement('button');
      node.setAttribute('class', 'btn m-1');
      node.setAttribute('id', `page${i}`);
      node.setAttribute('onclick', `call_api_search('${category}', '${query}', ${i})`);
      node.innerHTML = `${i}`;
      
      // console.log(node);
      document.getElementById('pagination').appendChild(node);
  }

}

// function extract_page_data(xml, pg_num, max) {
//     var obj = JSON.parse(xml.responseText);
//     var book_results = obj.items;
//     var index = 0;
//     // var total_items = obj.totalItems;
//     // var num_of_pages = Math.ceil(total_items / max);
//     // console.log(total_items);
//     // console.log(num_of_pages);
    
//     for ( i = 1; i <= 5; i++ ) {
//         var node = document.createElement('button');
//         node.setAttribute('class', 'btn genre m-1');
//         node.setAttribute('onclick', `call_api_search('all', 'harry potter', ${i}); reset_button(${i}); select_button(${i})`);
//         node.innerHTML = `${i}`;
        
//         // console.log(node);
//         document.getElementById('pagination').appendChild(node);
//     }

// }

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


function redirect_to_book_search(query, category){
    location.href = `book_search.html?query=${query}&category=${category}`;
  }
