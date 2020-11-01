
// hardcoded:
var samplePerson = {
  'userid': 'aytt',
  'name': 'Au Yong Ting Ting',
  'wishlist_isbn': ['0141346809', '0070704848', '0309086280', '1781100489', '0596554877'],
  'listings_isbn_and_reserveStatus': [['0070704848', 'YES'], ['1408135752', 'NO'], ['1449344607', 'YES']]
};


function getWishlist() {
    document.getElementById('wishlist_cards').innerHTML = '';
    var isbn_list = samplePerson.wishlist_isbn;
    console.log(isbn_list);

    for (var isbn of isbn_list) {
      get_wishlist_book(isbn);
    }

};

function getListings(status) {
  document.getElementById("myListings_cards").innerHTML = '';
  var isbn_status_list = samplePerson.listings_isbn_and_reserveStatus;
  if (status == 'ALL') {
    for (var book of isbn_status_list) {
      var isbn = book[0];
      get_listings_book(isbn);
    };
  } else {
    
    for (var book of isbn_status_list) {
      var isbn = book[0];
      var reserve = book[1];
      if (reserve == status) {
        get_listings_book(isbn);
      }
    }
  }
  
};



function get_wishlist_book(isbn) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var json_obj = JSON.parse(request.responseText);
            var items = json_obj.items;
            var html_text = '';

            for (item of items) {
                var image = item.volumeInfo.imageLinks.thumbnail;
                var title = item.volumeInfo.title;
                var desc = item.volumeInfo.description;
                //var updated = ; // put time updqated 

                html_text += `
                <div class="container d-inline-block" id="personal">
                  <img src="${image}" alt="bookimage" class="image" style="width:100%">
                  <div class="middle">
                    <div class="text"><b>${title}</b><br>${desc}</div>
                  </div>
                </div>
                `;

                

            }

            document.getElementById('wishlist_cards').innerHTML += html_text;


    }
}

    // var key = 'AIzaSyBJzLG1vPJaSlyl0bJ2xXI7uTz5Xx97jUE';
    // var userid = '105224440927779280831';
    // var wishlist_shelf = '1001';
    var url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`;

    
    request.open("GET", url, true);

    request.send();

  
}

function get_listings_book(isbn) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var json_obj = JSON.parse(request.responseText);
            var items = json_obj.items;

            var html_text = "";

            for (item of items) {// incomplete, based on db
                var image = item.volumeInfo.imageLinks.thumbnail;
                var title = item.volumeInfo.title;
                var desc = item.volumeInfo.description;
                //var updated = ; // put time updqated 

                html_text += `
                <div class="container d-inline-block" id="personal">
                  <img src="${image}" alt="bookimage" class="image" style="width:100%">
                  <div class="middle">
                    <div class="text"><b>${title}</b><br>${desc}</div>
                  </div>
                </div>
                `;

            }

            document.getElementById("myListings_cards").innerHTML += html_text;


    }
    }

    // var userid = '105224440927779280831';
    // var listings_shelf = '1002';
    var url = `https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}`;

    request.open("GET", url, true);

    request.send();



}


