/*
* use this version with bottom bar
*/
const sbTime = 8000;
let sbMyTimer; // used to control setInterval and clearInterval

var slideIndex = 1;
if (location.pathname !== "/") {
  jQuery(document).ready(function () {
    jQuery.ajax({
      type: "GET",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "get_sales_banner_slider",
      },
      success: function (result) {
        jQuery(result.data).insertBefore("#content");
        sbShowSlides(slideIndex);
        sbMyTimer = setInterval(function () {
          sbPlusSlides(1);
        }, sbTime);
      },
      error: function () {
        console.log("Error occured");
      },
    });
  });
}

sbShowSlides(slideIndex);
sbMyTimer = setInterval(function () {
  sbPlusSlides(1);
}, sbTime);

function sbPlusSlides(n) {
  clearInterval(sbMyTimer);

  if (n < 0) {
    sbShowSlides((slideIndex -= 1));
  } else {
    sbShowSlides((slideIndex += 1));
  }
  if (n === -1) {
    sbMyTimer = setInterval(function () {
      sbPlusSlides(n + 2);
    }, sbTime);
  } else {
    sbMyTimer = setInterval(function () {
      sbPlusSlides(n + 1);
    }, sbTime);
  }
}

function sbShowSlides(n) {
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
