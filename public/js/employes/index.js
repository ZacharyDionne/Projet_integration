let radios = document.getElementsByClassName("xmlRadio");
for (let i = 0; i < radios.length; i++)
{
	radios[i].addEventListener("change", change);
}

function change(e)
{
	let form = e.target.parentNode;
	let id = form.getAttribute("employe");
	let formData = new FormData(form);
	let request = new XMLHttpRequest();

	request.open("post", "/employes/" + id + "/update");
	request.send(formData);

	request.addEventListener("load", load);
	request.addEventListener("error", error);
}


function load(e)
{
	console.log(e.target.response);
}

function error(e)
{
	console.error(e);
}