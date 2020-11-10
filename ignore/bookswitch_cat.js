function call_api(){
    var request = new XMLHttpRequest;
    
    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){
            // console.log(request.responseText);
            var obj = JSON.parse(request.responseText);

            var books_result = obj.items;
            var index = 0;

            // console.log(books_result);
            // console.log(document.getElementById('results'));
            for (each_book in books_result){
                var str = '';
                var title = books_result[each_book].volumeInfo.title;
                var isbn = books_result[each_book].volumeInfo.industryIdentifiers[0].identifier;
                var shortDesc = books_result[each_book].volumeInfo.description.slice(0,300) + '...';
                var selfLink = books_result[each_book].selfLink;
                var image = get_image(selfLink, index);
                // console.log(books_result[each_book]);
                // console.log(title);
                // console.log(isbn);
                // console.log(shortDesc);
                // console.log(selfLink);
                // console.log(image);

                str += `
                    <div class="col-lg-3 col-6 mb-4">
                        <div class="card h-100 border-0">
                        <a href="#"><img class="card-img-top" src="./unnamed.jpg" alt=""></a>
                        <div class="card-body">
                            <h6 class="card-title">
                            <a href="#">${title}</a>
                            </h6>
                        </div>
                        </div>
                    </div>`;

                document.getElementById('main-content').innerHTML += str;
                index += 1;
            }
        }
    }

    var url = 'https://www.googleapis.com/books/v1/volumes?q=queen';
    request.open('GET', url, true);
    request.send();
}

call_api();

function get_image(selfLink, index){
    // console.log(selfLink);
    var request = new XMLHttpRequest;
    var imageLink = '';
    console.log(selfLink);
    request.onreadystatechange = function(){
        if (request.readyState==4 && request.status==200){

            var obj = JSON.parse(request.responseText);
            imageLink = obj.volumeInfo.imageLinks.thumbnail;
            document.getElementsByClassName('card-img-top')[index].setAttribute('src', imageLink);
            // console.log(imageLink);

        }
    }

    var url = selfLink;
    request.open('GET', url, true);
    request.send();

    return imageLink;
}


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