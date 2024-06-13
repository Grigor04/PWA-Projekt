(function ($) {
	
	"use strict";

	// Window Resize Mobile Menu Fix
	mobileNav();


	// Scroll animation init
	window.sr = new scrollReveal();
	

	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {	
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	$('a[href*=\\#]:not([href=\\#])').on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var width = $(window).width();
				if(width < 991) {
					$('.menu-trigger').removeClass('active');
					$('.header-area .nav').slideUp(200);	
				}				
				$('html,body').animate({
					scrollTop: (target.offset().top) - 130
				}, 700);
				return false;
			}
		}
	});

	$(document).ready(function () {
	    $(document).on("scroll", onScroll);
	    
	    //smoothscroll
	    $('a[href^="#"]').on('click', function (e) {
	        e.preventDefault();
	        $(document).off("scroll");
	        
	        $('a').each(function () {
	            $(this).removeClass('active');
	        })
	        $(this).addClass('active');
	      
	        var target = this.hash,
	        menu = target;
	       	var target = $(this.hash);
	        $('html, body').stop().animate({
	            scrollTop: (target.offset().top) - 130
	        }, 500, 'swing', function () {
	            window.location.hash = target;
	            $(document).on("scroll", onScroll);
	        });
	    });
	});

	function onScroll(event){
	    var scrollPos = $(document).scrollTop();
	    $('.nav a').each(function () {
	        var currLink = $(this);
	        var refElement = $(currLink.attr("href"));
	        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
	            $('.nav ul li a').removeClass("active");
	            currLink.addClass("active");
	        }
	        else{
	            currLink.removeClass("active");
	        }
	    });
	}


	// Home seperator
	if($('.home-seperator').length) {
		$('.home-seperator .left-item, .home-seperator .right-item').imgfix();
	}


	// Home number counterup
	if($('.count-item').length){
		$('.count-item strong').counterUp({
			delay: 10,
			time: 1000
		});
	}


	// Page loading animation
	$(window).on('load', function() {
		if($('.cover').length){
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}

		$("#preloader").animate({
			'opacity': '0'
		}, 600, function(){
			setTimeout(function(){
				$("#preloader").css("visibility", "hidden").fadeOut();
			}, 300);
		});
	});


	// Window Resize Mobile Menu Fix
	$(window).on('resize', function() {
		mobileNav();
	});


	// Window Resize Mobile Menu Fix
	function mobileNav() {
		var width = $(window).width();
		$('.submenu').on('click', function() {
			if(width < 992) {
				$('.submenu ul').removeClass('active');
				$(this).find('ul').toggleClass('active');
			}
		});
	}
	
	$(document).on("click", ".naccs .menu div", function() {
    var container = $(this).closest('.naccs'); // Find the closest container
    var numberIndex = $(this).index();

    if (!$(this).is("active")) {
        container.find(".menu div").removeClass("active");
        container.find("ul li").removeClass("active");

        $(this).addClass("active");
        container.find("ul").find("li:eq(" + numberIndex + ")").addClass("active");

        var listItemHeight = container.find("ul").find("li:eq(" + numberIndex + ")").innerHeight();
        container.find("ul").height(listItemHeight + "px");
    }
});



})(window.jQuery);

document.addEventListener("DOMContentLoaded", function(event) { 
  const autosuggestOptions = document.getElementById('blog-itemi');
    // Dohvaćamo unos korisnika
    const input = this.value;
    
    // Dohvaćamo JSON podatke putem HTTP zahtjeva
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://excelum.hr/blog.json', true);
    xhr.onload = function() {
      if (this.status === 200) {
        const data = JSON.parse(this.responseText);
		let html = '';
		let slika = "";
		for (var i = 0; i < data.length; i++) {
		let broj = i+1;
		slika = "assets/blog/" + data[i].slika;
			html += `
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="blog-post-thumb">
            <div class="img">
                <img src="`
				
				+ slika +
				
				`" alt="">
            </div>
            <div class="blog-content">
                <h3>
                    <a href="#">`
					
					+ data[i].naslov +
					
					`</a>
                </h3>

                <a
				href="`
				+ '#popup' + broj +
				`"
				class="main-button">Saznajte vise</a>
            </div>
        </div>
    </div>
	
	<div
	id="`+ 'popup' + broj +`"
	class="overlay">
	<div class="popup">
		<h2>`
		+ data[i].naslov +
		`</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">`
			+ data[i].tekst +
		`</div>
	</div>
</div>
`;
	
	
			}
        
        
        // Prikazujemo autosuggest opcije
        autosuggestOptions.innerHTML = html;
      }
    }
    xhr.send();
});

$(document).on("click", ".naccss .menu div", function() {
	var numberIndex = $(this).index();

	if (!$(this).is("active")) {
		$(".naccss .menu div").removeClass("active");
		$(".naccss ul li").removeClass("active");

		$(this).addClass("active");
		$(".naccss ul").find("li:eq(" + numberIndex + ")").addClass("active");

		var listItemHeight = $(".naccss ul")
			.find("li:eq(" + numberIndex + ")")
			.innerHeight();
		$(".naccss ul").height(listItemHeight + "px");
	}
});