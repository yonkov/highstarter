// Nodelist forEach polyfill IE9+, Edge and Safari
if (typeof NodeList.prototype.forEach !== 'function')  {
	NodeList.prototype.forEach = Array.prototype.forEach;
}
// Element.matches() polyfill IE 9+
if (!Element.prototype.matches) {
	Element.prototype.matches = Element.prototype.msMatchesSelector ||
	Element.prototype.webkitMatchesSelector;
}

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
		// recursively go up the DOM adding matches to the parents array
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
			//toggle highlight class on the parent li items that remain focused
			el.classList.toggle("highlight");
		});
	};
	document.querySelectorAll('ul .menu-item-has-children a').forEach(function(el) {
		el.addEventListener("focus", toggleHighlight)
	});
	document.querySelectorAll('ul .menu-item-has-children a').forEach(function(el) {
		el.addEventListener("blur", toggleHighlight)
	});
});