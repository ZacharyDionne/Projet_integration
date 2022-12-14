export class UI {

    //Créer une roue de chargement Bootstrap
    static createSpinner()
    {
        let spinner = document.createElement("div");
        spinner.setAttribute("class", "spinner-border position-absolute");
        spinner.setAttribute("role", "status");
    
        let span = document.createElement("span");
        span.setAttribute("class", "visually-hidden");
        span.innerText = "Chargement...";
    
        spinner.appendChild(span);
    
        return spinner;
    }


    //Créer un popup alerte Bootstrap
    static createAlerte()
    {
        let alert = document.createElement("div");
        let button = document.createElement("button");

        //Consruction de l'alerte
        alert.setAttribute("class", "alert alert-danger alert-dismissible fade show position-absolute");
        alert.setAttribute("role", "alert");
        alert.setAttribute('style', 'z-index: 10000;');
        alert.innerText = "Une erreur interne est survenue. Si l'erreur persiste, veuillez contacter votre responsable.";

        //Construction du bouton
        button.setAttribute("type", "button");
        button.setAttribute("class", "btn-close");
        button.setAttribute("data-bs-dismiss", "alert");
        button.setAttribute("aria-label", "Close");

        alert.appendChild(button);

        return alert;
    }
}


