$(document).ready(function() {

	var lang = (window.location.href.match(/\/en\//)? 'en' : 'cs');
	
/* cufon ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	Cufon.replace('h1, h2, .lead');
	
/* corners ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	$('#menu li a').rounded([0, 0, 2, 2]);
	$('.more, .published, .projects em, .who em, .projects .client').rounded(4);
	$('.published .pub-month').rounded([0, 0, 4, 4]);
	$('#blocks, .businesscard, .contact').rounded(6);
	$('.footer, #tabs a').rounded([4, 4, 0, 0]);
	
/* lines ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	$('.section h2').not('#blocks h2').wrap($('<div class="line"></div>'));
	
/* logo grid ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	$('.logogrid li, .projects tr').each(function () {
	  $('img', this).css('opacity', 0.5)
	  $(this).hover(function(){
		  $('img', this).stop().animate({'opacity': 1});
	  },function(){
	      $('img', this).stop().animate({'opacity': 0.5});
	  });
	});
	
//	$('.mainrightcol .clients, .mainrightcol .contracts').css('cursor', 'pointer').find('img').click(function () {
//		windows.location.href = ... //references 
//	});

/* scrolling time ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	var scrollTime = 600;
	
/* tabs ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	if ($('#tabs').length) {
		$('#tabs a, .contacts .more').click(function(e) {
			e.preventDefault();
			var id = '#' + $(this).attr('href').replace(/^.*#/, '');
			$('#tabs a').closest('li').removeClass('active');
			$('#tabs a[href="' + id + '"]').closest('li').addClass('active');
			$(id).show();
			$('.tab').not(id).hide();
			if ($(this).is('.contacts .more')) {
				$(window).scrollTo($(id), scrollTime);
			}
		});
	
		if (!document.location.hash) {
			$('#tabs a').eq(0).click();
		} else {
			$('#tabs a[href="' + document.location.hash + '"]').click();
		}
	}
	
/* scrolling ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	$.localScroll.hash({
		duration: scrollTime
	});
	$.localScroll({
		duration: scrollTime,
		hash: true
	});

/* map ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
	if ($('#map-canvas').length > 0 && GBrowserIsCompatible()) {
		var zoom = (lang == 'cs')? 7 : 5;
		
		var map = new GMap2(document.getElementById('map-canvas'));
		map.addControl(new GLargeMapControl3D());
	    map.setCenter(new GLatLng(49.7, 16.2), zoom, G_NORMAL_MAP);

	    function createMarker(point) {
			var marker = new GMarker(point);
			GEvent.addListener(marker, 'click', function() {
				map.panTo(point);
			});
			return marker;
		}
	    
	    $('.geo').each(function() {
	        var l = $(this).attr('title').split(';');
	        var point = new GLatLng(l[0], l[1]);
	        
		    map.addOverlay(createMarker(point));
		    $('h3 abbr, img', $(this).closest('th')).css('cursor', 'pointer').click(function() {
		    	map.panTo(point);
		    });
		});
	}
	
});
