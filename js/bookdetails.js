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
              "</span> <button onclick='myFunction()' class='btn black-background white' id='myBtn' style = 'color:white;'>Read more</button>";
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

