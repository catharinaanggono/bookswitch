function display_default() { //default
    call_book("9781760553128");
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

            document.getElementById("author").innerText= "Author: " + author;
            document.getElementById("published_date").innerText= "Published Date: " + published_date;
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
            document.getElementById("bk_description").innerHTML= desc + "<span id='dots'></span>" +
            "<span id='more'>" + secondDesc + "</span> <br><button onclick='myFunction()' class='btn btn-outline-primary' id='myBtn'>Read more</button>";
            
        }

    }
    
    var key = "AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE";
    var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:9781760553128';

    request.open("GET", url, true);
    request.send();
}

