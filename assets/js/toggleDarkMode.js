document.addEventListener('DOMContentLoaded', function() {

	var cookieStorage = {
		setCookie: function setCookie(key, value, time, path) {
			var expires = new Date();
			expires.setTime(expires.getTime() + time);
			var pathValue = '';

			if (typeof path !== 'undefined') {
				pathValue = 'path=' + path + ';';
			}

			document.cookie = key + '=' + value + ';' + pathValue + 'expires=' + expires.toUTCString();
		},
		getCookie: function getCookie(key) {
			var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
			return keyValue ? keyValue[2] : null;
		},

		removeCookie: function removeCookie(key) {   
			document.cookie = key + '=; Max-Age=0; path=/';
		}
	};

	var body = document.getElementsByTagName("body")[0]
	var switcher = document.getElementsByClassName('wpnm-button')[0];

	//Click on dark mode icon. Add dark mode classes and wrappers. Store user preference through sessions
	switcher.addEventListener("click", function() {

		this.classList.toggle('active');

		//If dark mode is selected
		if (this.classList.contains('active')) {
			body.classList.add('dark-mode');
			//Save user preference as a cookie
			cookieStorage.setCookie('kickstarterNightMode', 'true', 2628000000, '/');
		} else {
			body.classList.remove('dark-mode');
			setTimeout(() => {
				cookieStorage.removeCookie('kickstarterNightMode');
			}, 100);
		}

	})

	//Check Storage. Keep user preference on page reload
	if (cookieStorage.getCookie('kickstarterNightMode')) {
		body.classList.add('dark-mode');
		switcher.classList.add('active');
	}

})