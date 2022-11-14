import { createSpinner } from "../modules/ui.js";

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


	//Gestion du retour de la requête
	request.addEventListener("load", load);
	request.addEventListener("error", error);
	request.addEventListener("loadend", endXML);


	//Envoie de la requête
	request.open("post", "/employes/" + id + "/update");
	request.send(formData);


	//Affiche le spin
	let spin = createSpinner();
	form.appendChild(spin);


	//stockage des informations
	requests.push(request);
	spins.push(spin);
}


function load(e)
{
	if (e.target.status === 500)
		error(e);
}

function error(e)
{
	let index = requests.findIndex(element => element == e.target);
	let spin = spins[index];
	let alert = document.createElement("div");
	let button = document.createElement("button");

	//Consruction de l'alerte
	alert.setAttribute("class", "alert alert-danger alert-dismissible fade show position-absolute");
	alert.setAttribute("role", "alert");
	alert.innerText = "Une erreur interne est survenue. Si l'erreur persiste, veuillez contacter votre responsable.";

	//Construction du bouton
	button.setAttribute("type", "button");
	button.setAttribute("class", "btn-close");
	button.setAttribute("data-bs-dismiss", "alert");
	button.setAttribute("aria-label", "Close");

	alert.appendChild(button);

	spin.parentNode.appendChild(alert);
}





function endXML(e)
{
	let index = requests.findIndex(element => element == e.target);
	let spin = spins[index];
	let checkbox = spin.parentNode.parentNode.getElementsByClassName("form-check")[0].querySelector("input");

	//Enlever le spin
	spin.parentNode.removeChild(spin);

	//Réactiver le checkbox
	checkbox.removeAttribute("disabled");

	//Libérer les informations stockées
	spins.splice(index);
	requests.splice(index);

}