const time = 8000;
let myTimer; // used to control setInterval and clearInterval

var slideIndex = 1;

if(location.pathname !== '/'){
jQuery(document).ready(function () {

  jQuery.ajax({
    type: "GET",
    url: "/wp-admin/admin-ajax.php",
    data: {
      action: "get_sales_banner_slider",
    },
    success: function (result) {
      
      jQuery(result.data).insertBefore("#main");
      showSlides(slideIndex);
      myTimer = setInterval(function () {
        plusSlides(1);
      }, time);
    },
    error: function () {
      console.log("Error occured");
    },
  });
});
}

showSlides(slideIndex);
myTimer = setInterval(function () {
  plusSlides(1);
}, time);


function plusSlides(n) {
  clearInterval(myTimer);
  
  if (n < 0) {
    showSlides((slideIndex -= 1));
  } else {
    showSlides((slideIndex += 1));
  }
  if (n === -1) {
    myTimer = setInterval(function () {
      plusSlides(n + 2);
    }, time);
  } else {
    myTimer = setInterval(function () {
      plusSlides(n + 1);
    }, time);
  }
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");

  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[slideIndex - 1].style.display = "block";
}
