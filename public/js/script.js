const $btn = $(".openbtn");
const $menuScreen = $(".screen");


$menuScreen.hide();

$btn.click(function () {
  $(this).toggleClass('active');
});

$btn.on("click", function () {
  $menuScreen.toggleClass("fadein");

  if ($menuScreen.hasClass("fadein")) {
    $menuScreen.stop().fadeIn(500);
  } else {
    $menuScreen.stop().fadeOut(500);
  }

})

var openBtn = document.querySelector('.openbtn');

window.addEventListener('scroll', function () {
  if (window.scrollY > 850) {
    openBtn.classList.add('scrolled');
  } else {
    openBtn.classList.remove('scrolled');
  }
});

$(document).ready(function () {
  var images1 = ['./images/image1.jpg', './images/image2.jpg', './images/image3.jpg']; // img1に表示する画像のパス
  var images2 = ['./images/image4.jpg', './images/image5.jpg', './images/image6.jpg']; // img2に表示する画像のパス
  var currentImage1 = 0;
  var currentImage2 = 0;

  function changeImages() {
    // img1のフェードアウトとフェードイン
    $('.img1').fadeOut(1000, function () {
      $(this).attr('src', images1[currentImage1]).fadeIn(1000);
    });

    // img2のフェードアウトとフェードイン
    $('.img2').fadeOut(1000, function () {
      $(this).attr('src', images2[currentImage2]).fadeIn(1000);
    });

    // 次の画像に切り替えるために現在の画像インデックスをインクリメント
    currentImage1 = (currentImage1 + 1) % images1.length;
    currentImage2 = (currentImage2 + 1) % images2.length;
  }


  // 6000ミリ秒（6秒）ごとにchangeImages関数を呼び出す
  setInterval(changeImages, 6000);
});
