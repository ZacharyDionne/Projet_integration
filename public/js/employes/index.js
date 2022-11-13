//Ajout de l'événement
let radios = document.getElementsByClassName("xmlCheckbox");
for (let i = 0; i < radios.length; i++)
{
	radios[i].addEventListener("change", change);
}

//déclaration des tableaux de lien (request -> spin)		*ceci sert à enlever la roue de chargement*
let spins = [];
let requests = [];

function change(e)
{
	let form = e.target.parentNode.parentNode;
	let id = form.getAttribute("employe");
	let formData = new FormData(form);
	let request = new XMLHttpRequest();

	//Désactiver le checkbox
	e.target.setAttribute("disabled", "");

	//Envoie de la requête
	request.open("post", "/employes/" + id + "/update");
	request.send(formData);

	//Gestion du retour de la requête
	request.addEventListener("load", load);
	request.addEventListener("error", error);

	//Affiche le spin
	let spin = form.getElementsByClassName("spinner-border")[0];
	spin.style.borderLeftColor = "black";
	spin.style.borderTopColor = "black";
	spin.style.borderBottomColor = "black";

	//stockage des informations
	requests.push(request);
	spins.push(spin);
}


function load(e)
{
	endXML(e);
}

function error(e)
{
	endXML(e);
	console.error(e);
}





function endXML(e)
{
	let index = requests.findIndex(element => element == e.target);
	let spin = spins[index];
	let checkbox = spin.parentNode.parentNode.getElementsByClassName("form-check")[0].querySelector("input");

	//Cacher le spin
	spin.style.borderLeftColor = "transparent";
	spin.style.borderTopColor = "transparent";
	spin.style.borderBottomColor = "transparent";

	//Réactiver le checkbox
	checkbox.removeAttribute("disabled");

	//Libérer les informations stockées
	spins.splice(index);
	requests.splice(index);
}