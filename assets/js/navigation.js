jQuery(function($) {
	//Mobile navigation
	var menuToggle = document.getElementById( 'menu-toggle' ),
    navMenu = document.getElementById( 'site-navigation' );
        
	menuToggle.onclick = function() {
		menuToggle.classList.toggle( 'open' );
		navMenu.classList.toggle( 'open' );
	};
	//Keyboard navigation
	$('ul .menu-item-has-children').hover(
		function(){$(this).addClass("highlight");},
		function(){$(this).delay('250').removeClass("highlight");}
	);
		
	$('ul .menu-item-has-children a').on('focus blur',
		function(){$(this).parents("li").toggleClass("highlight");}
	);
});