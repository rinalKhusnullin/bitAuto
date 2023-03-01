var button = document.getElementById("show");
button.onclick = show1;

function show1(){
	if(document.getElementById("show1").type === 'password') {
		document.getElementById("show1").type = 'text';
		button.className = 'far fa-eye-slash';
	} else {
		document.getElementById("show1").type = 'password';
		button.className = 'far fa-eye';
	}
};