document.addEventListener('DOMContentLoaded', function() {
	var body = document.body;
	var switcher = document.getElementsByClassName('wpnm-button')[0];
	if (!switcher) return;
	
	//Click on dark mode icon. Add dark mode classes and wrappers. Store user preference through sessions
	switcher.addEventListener("click", function() {
		this.classList.toggle('active');
		//If dark mode is selected
		if (this.classList.contains('active')) {
			body.classList.add('dark-mode');
			localStorage.setItem('highstarterNightMode', 'true');
		} else {
			body.classList.remove('dark-mode');
			setTimeout(function(){
				localStorage.removeItem('highstarterNightMode');
			}, 100);
		}
	})

	//Check Storage. Keep user preference on page reload
	if (localStorage.getItem('highstarterNightMode')) {
		body.classList.add('dark-mode');
		switcher.classList.add('active');
	}
})