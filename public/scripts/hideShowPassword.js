var button = document.getElementById("show");
button.onclick = show;
var input = document.getElementById("show1");
var icon = document.getElementById("i");
function show () {
	if(input.getAttribute('type') == 'password') {
		input.removeAttribute('type');
		input.setAttribute('type', 'text');
		button.className = 'far fa-eye-slash';
	} else {
		input.removeAttribute('type');
		input.setAttribute('type', 'password');
		button.className = 'far fa-eye';
	}
}