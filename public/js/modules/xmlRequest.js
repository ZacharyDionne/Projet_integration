import { UI } from "./UI.js";


export class XmlRequest {

	//déclaration des tableaux de lien (request -> spin)		*ceci sert à enlever la roue de chargement*
	static #spins = [];
	static #requests = [];
	static #user = [];

	static init(userType)
	{
		XmlRequest.#user = userType;

		//Ajout de l'événement
		let checkBoxes = document.getElementsByClassName("xmlCheckbox");
		for (let i = 0; i < checkBoxes.length; i++)
		{
			checkBoxes[i].addEventListener("change", XmlRequest.#change);
		}
	}


	static #change(e)
	{
		let form = e.target.parentNode.parentNode;
		let id = form.getAttribute(XmlRequest.#user);
		let formData = new FormData(form);
		let request = new XMLHttpRequest();
	
		//Désactiver le checkbox
		e.target.setAttribute("disabled", "");
	
	
		//Gestion du retour de la requête
		request.addEventListener("load", XmlRequest.#load);
		request.addEventListener("error", XmlRequest.#error);
		request.addEventListener("loadend", XmlRequest.#endXML);
	
	
		//Envoie de la requête
		request.open("post", "/" + XmlRequest.#user + "s/" + id + "/update");
		request.send(formData);
	
	
		//Affiche le spin
		let spin = UI.createSpinner();
		form.appendChild(spin);
	
	
		//stockage des informations
		XmlRequest.#requests.push(request);
		XmlRequest.#spins.push(spin);
	}



	static #load(e)
	{
		if (e.target.status === 500)
			XmlRequest.#error(e);
	}

	static #error(e)
	{
		let index = XmlRequest.#requests.findIndex(element => element == e.target);
		let spin = XmlRequest.#spins[index];
		let alert = UI.createAlerte();
		let checkBox = spin.parentNode.getElementsByClassName("form-check")[0];

		spin.parentNode.appendChild(alert);

		//Remettre le checkbox à son état original
		//checkBox.setAttribute("checked", !(checkBox.getAttribute("checked") === ""));
		console.log("a" + checkBox.getAttribute(checked));
	}

	static #endXML(e)
	{
		let index = XmlRequest.#requests.findIndex(element => element == e.target);
		let spin = XmlRequest.#spins[index];
		let checkbox = spin.parentNode.parentNode.getElementsByClassName("form-check")[0].querySelector("input");

		//Enlever le spin
		spin.parentNode.removeChild(spin);

		//Réactiver le checkbox
		checkbox.removeAttribute("disabled");

		//Libérer les informations stockées
		XmlRequest.#spins.splice(index);
		XmlRequest.#requests.splice(index);
	}

}













