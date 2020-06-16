let box = document.getElementById('box-info');

box.addEventListener('click', ()=>{
	if(box.style.display == "none"){
		box.style.display = "flex";
	}
	else {
		box.style.display = "none";
	}
});