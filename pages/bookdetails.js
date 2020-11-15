function display_default(isbn) { //default
    call_book(isbn);
}

function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Read less"; 
      moreText.style.display = "inline";
    }
}

function call_book(id){
    var request = new XMLHttpRequest();
    
    request.onreadystatechange = function(){

        if (request.readyState==4 && request.status==200) {

            //console.log(xml.responseText);
            var output = JSON.parse(request.responseText);
            console.log(output);

            var items = output.items;
            var info = items[0].volumeInfo;
            var title = info.title;
            var author = info.authors;
            var description = info.description;
            var published_date = info.publishedDate;
   
            // ratings? supposed to be in the database - dummy data 
            if (info.imageLinks.small == undefined) {
                var imageLink = info.imageLinks.smallThumbnail;
            } else {
                var imageLink = info.imageLinks.small;
            }

            document.getElementById("author").innerHTML= author;
            document.getElementById("published_date").innerHTML=  published_date;
            document.getElementById("BkImg").src = imageLink;
            document.getElementById("BkImg").src = imageLink;
            document.getElementById("bookTitle").innerText= title;
            
            var desc = ""; 
            var secondDesc = ""; 
            var fullStop = 0; 
            var lengthDesc = description.length;

            for (i=0;i<lengthDesc;i++) {
                if (fullStop == 2) {
                    secondDesc += description[i];
                } else { 
                    if (description[i] == ".") {
                        fullStop ++; 
                        desc += description[i];
                    } else { 
                        desc += description[i]; 
                    }    
                }
            }

            if (secondDesc != "") {
              document.getElementById("bk_description").innerHTML=  desc + "<span id='dots'></span>" +
              "<span id='more' style = 'padding-top: 10px;'>" + secondDesc + 
              "</span> <button onclick='myFunction()' class='btn black-background white' id='myBtn'>Read more</button>";
            } else { 
              document.getElementById("bk_description").innerHTML=  desc + "<span id='dots'></span>" +
              "<span id='more' style = 'padding-top: 10px;'>";
            }
           
         ;
        }

    }
    
    var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
    var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:'+id;
    console.log("check id");
    console.log(id);

    request.open("GET", url, true);
    request.send();


}

// $("#autocomplete").autocomplete({
//     appendTo: $('#search'),
//     source: function (request, response) {
//       $.ajax({
//         url: "https://www.googleapis.com/books/v1/volumes?",
//         data: { 
//           q: request.term,
//           startIndex: 1,
//           maxResults: 15
//         },
//         success: function (data) {
//           data = data.items;
//           var matcher1 = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
//           var matcher2 = new RegExp("^.+" + $.ui.autocomplete.escapeRegex( request.term ), "i");
  
//           console.log(data);
  
//           var primary_matches = $.map(data, function (el) {
//             let result = el.volumeInfo.title;
//             let img_link = el.volumeInfo.imageLinks;
//             let authors = el.volumeInfo.authors;
//             console.log(authors);
//             if (typeof img_link !== 'undefined'){
//               img_link = el.volumeInfo.imageLinks.thumbnail;
//             }
//             else{
//               img_link = '../images/no_image-removebg-preview.svg'
//             }
//             if (typeof authors == 'undefined'){
//               authors = "AUTHOR UNKNOWN";
//             }            
//             if (matcher1.test(result) || matcher1.test(authors)){
//               return {
//                 imgLink: img_link,
//                 value: result,
//                 author: authors
//               };
  
//             }
              
//           });
//           var secondary_matches = $.map(data, function (el) {
//             let result = el.volumeInfo.title;
//             let img_link = el.volumeInfo.imageLinks;
//             let authors = el.volumeInfo.authors;
//             console.log("2" + authors);

//             if (typeof img_link !== 'undefined'){
//               img_link = el.volumeInfo.imageLinks.thumbnail;
//             }
//             else{
//               img_link = '../images/no_image-removebg-preview.svg'
//             }
//             if (typeof authors == 'undefined'){
//               authors = "AUTHOR UNKNOWN";
//             }       
//             if (matcher2.test(result) || matcher2.test(authors)){
//               return {
//                 imgLink: img_link,
//                 value: result,
//                 author: authors
//               };
  
//             }
              
//           });
//           console.log(primary_matches);
//           console.log(secondary_matches);
//           response($.merge(primary_matches, secondary_matches));
//         },
        
//         // error: function () {
//         //   response([]);
//         // }
//       });
//     }
//   })
//   .data("ui-autocomplete")._renderItem = function( ul, item ) {
//         var titleText = String(item.value).replace(
//         new RegExp(this.term, "gi"),
//         "<span class='ui-state-highlight'><b>$&</b></span>");
//         var authorText = String(item.author).replace(
//         new RegExp(this.term, "gi"),
//         "<span class='ui-state-highlight'><b>$&</b></span>");

//         return $( "<li></li>" )
//         .attr( "data-value", item)
//         .append("<div class='row'><div class='col-3'><img width='62' height='85' src='" + item.imgLink + "'></div>" + "<div class='col'><div class='row'><div class='col'><p style='font-size:15px'>" + titleText + "</p></div></div>" + "<div class='row'><div class='col'><p style='font-size:10px'>" + authorText + "</p></div></div></div>")
//         .appendTo( ul );
//     };

// document.getElementById("autocomplete").onkeypress = function(event){
//   if (event.keycode == 13 || event.which == 13){
//     var query = document.getElementById("autocomplete").value;
//     var category = 'all';
//     redirect_to_book_search(query, category);
//   }
// };


// function redirect_to_book_search(query, category){
//     location.href = `book_search.html?query=${query}&category=${category}`;
//   }
