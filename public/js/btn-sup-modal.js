window.onload = function () {

	var btn1 = document.querySelector('.btn1');

	var btn1Front = btn1.querySelector('.btn1-front'),
		btn1Yes = btn1.querySelector('.btn1-back .yes'),
		btn1No = btn1.querySelector('.btn1-back .no');

	btn1Front.addEventListener('click', function (event) {
		var mx = event.clientX - btn1.offsetLeft,
			my = event.clientY - btn1.offsetTop;

		var w = btn1.offsetWidth,
			h = btn1.offsetHeight;

		var directions = [
			{ id: 'top', x: w / 2, y: 0 },
			{ id: 'right', x: w, y: h / 2 },
			{ id: 'bottom', x: w / 2, y: h },
			{ id: 'left', x: 0, y: h / 2 }
		];

		directions.sort(function (a, b) {
			return distance(mx, my, a.x, a.y) - distance(mx, my, b.x, b.y);
		});

		btn1.setAttribute('data-direction', directions.shift().id);
		btn1.classList.add('is-open');
	});

	//desactivation de se btn car quand on confirme la supression le compte s efface et on astop l animation de retour car peu porter a confussion

	/* btn1Yes.addEventListener( 'click', function( event ) {
		btn1.classList.remove( 'is-open' );
	} ); */

	btn1No.addEventListener('click', function (event) {
		btn1.classList.remove('is-open');
	});

	function distance(x1, y1, x2, y2) {
		var dx = x1 - x2;
		var dy = y1 - y2;
		return Math.sqrt(dx * dx + dy * dy);
	}

};