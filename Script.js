
        // Set the end date and time of the sale (adjust as needed)
        var saleEndTime = new Date("2024-08-31T23:59:59").getTime();

        // Update the countdown every second
        var countdownInterval = setInterval(function() {
            var now = new Date().getTime();
            var timeRemaining = saleEndTime - now;

            // Calculate days, hours, minutes, and seconds
            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            // Display the countdown
            document.getElementById("countdown").innerHTML = days + " Days : " + hours + " Hrs : " + minutes + " Mins : " + seconds + " Secs ";

            // If the countdown is over, display a message
            if (timeRemaining < 0) {
                clearInterval(countdownInterval);
                document.getElementById("countdown").innerHTML = "Sale has ended!";
            }
        }, 1000);


        // this script for adding the effect on reel

        var video = document.getElementById("myVideo");
    var videoPlayer = document.getElementById("videoPlayer");

    function showVideoPlayer() {
        videoPlayer.style.display = "block";
        video.pause();
        document.querySelector('.play-button').style.display = 'none';
    }

    function closeVideoPlayer() {
        videoPlayer.style.display = "none";
        video.play();
        document.querySelector('.play-button').style.display = 'block';
    }

    function previousVideo() {
        var mainVideo = document.getElementById("mainVideo");
        mainVideo.pause();
        // Add logic to change video source to previous video
    }

    function nextVideo() {
        var mainVideo = document.getElementById("mainVideo");
        mainVideo.pause();
        // Add logic to change video source to next video
    }
    

const filled = document.querySelector('.filled');

function update() {
  const scrollTop = window.scrollY;
  const documentHeight = document.body.scrollHeight;
  const windowHeight = window.innerHeight;
  const scrollPercent = (scrollTop / (documentHeight - windowHeight)) * 100;
  
  filled.style.width = `${scrollPercent}%`;
  
  requestAnimationFrame(update);
}

update();



//

(function ($) {

	// Products Slick
	$('.products-slick').each(function () {
		var $this = $(this),
			$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 2,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: true,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
				breakpoint: 991,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			},
			]
		});
	});




})(jQuery);


document.addEventListener("DOMContentLoaded", function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartCount = document.querySelector('.cart-count');
  
    addToCartButtons.forEach(button => {
      button.addEventListener('click', function() {
        let count = parseInt(cartCount.textContent);
        cartCount.textContent = count + 1;
      });
    });
  });
  
  
  
  const searchBar = document.getElementById('search-bar');
  const products = document.querySelectorAll('.product-box');
  const pageContent = document.getElementById('page-content');
  const productList = document.getElementById('product-list');

  searchBar.addEventListener('input', () => {
    const searchQuery = searchBar.value.toLowerCase();

    let matchFound = false;
    products.forEach(product => {
      const productName = product.getAttribute('data-name').toLowerCase();

      if (productName.includes(searchQuery)) {
        product.style.display = 'block';  // Show the product if it matches
        matchFound = true;
      } else {
        product.style.display = 'none';   // Hide the product if it doesn't match
      }
    });

    if (searchQuery.length > 0 && matchFound) {
      pageContent.style.display = 'none';  // Hide other content when searching
    } else {
      pageContent.style.display = 'block';  // Show other content if no search or no match
      products.forEach(product => product.style.display = 'block'); // Show all products
    }
  });