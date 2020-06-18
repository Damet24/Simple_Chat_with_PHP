


function searchCat(id){
	alert(id);
}

function ajaxPost(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onereadystatechange = () => {
		if (this.readyState == 4 && this.status == 200) {
			var t = responseText;
			alert("Se cargó la petición.");
		}
	};
	xhttp.open("GET", "../projects/chat/ajax_chat.php?query="+id, true);
	xhttp.send();
}