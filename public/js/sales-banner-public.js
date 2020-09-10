/**
 * use this version with top bar
 */

const sbTime = 8000;
let sbMyTimer; // used to control setInterval and clearInterval

var slideIndex = 1;

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
