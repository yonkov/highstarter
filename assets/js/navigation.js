document.addEventListener('DOMContentLoaded', function() {
	//Mobile navigation
	var menuToggle = document.getElementById( 'menu-toggle' ),
    navMenu = document.getElementById( 'site-navigation' );
	menuToggle.onclick = function() {
		menuToggle.classList.toggle( 'open' );
		navMenu.classList.toggle( 'open' );
	};
	
	//Keyboard navigation

	var getParents = function (elem, selector) {
		// Element.matches() polyfill IE 9+
		if (!Element.prototype.matches) {
			Element.prototype.matches = Element.prototype.msMatchesSelector ||
			Element.prototype.webkitMatchesSelector;
		}
		//Get all parent li elements
		var parents = [];  
		while (elem && (elem = elem.parentNode) !== document) {
			if (selector) {
				if (elem.matches(selector)) {
					parents.push(elem);
				}
				continue;
			}
			parents.push(elem);
		}
		return parents;
	};
	var toggleHighlight = function () {
		var parents = getParents(this, 'li');
		parents.forEach(function(el){
			el.classList.toggle("highlight");
		});
	};
	//Toggle highlight class on focus
	document.querySelectorAll('ul .menu-item-has-children a').forEach(function(el) {
		el.addEventListener("focus", toggleHighlight)
	});
	document.querySelectorAll('ul .menu-item-has-children a').forEach(function(el) {
		el.addEventListener("blur", toggleHighlight)
	});
});