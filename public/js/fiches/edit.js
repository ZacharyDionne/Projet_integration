import { ValidationFiche } from "../modules/fiches/ValidationFiche.js";

let table = document.getElementById("tableModification");
let tbody = table.querySelector("tbody");
let form = document.getElementById("formModification");
let rowTemplate = document.getElementById("rowTemplate");
let fini = document.getElementById("fini");

const SELECT_ALL = document.getElementById("selectAll");

const NO_ERROR_COLOR = "#ffffff";
const ERROR_COLOR = "#ff9c9c";

const BOUTON_FINI = document.getElementById("boutonTerminer");
const BOUTON_ENREGISTRER = document.getElementById("boutonEnregistrer");
const BOUTON_AJOUTER = document.getElementById("boutonAjouter");
const BOUTON_SUPPRIMER = document.getElementById("boutonSupprimer");

addEvents();






function addEvents()
{
    if (BOUTON_ENREGISTRER)
        BOUTON_ENREGISTRER.addEventListener("click", onEnregistrer);
    if (BOUTON_FINI)
        BOUTON_FINI.addEventListener("click", onTerminer);
    if (BOUTON_AJOUTER)
        BOUTON_AJOUTER.addEventListener("click", onAjouter);
    if (BOUTON_SUPPRIMER)
        BOUTON_SUPPRIMER.addEventListener("click", onSupprimer);
    if (SELECT_ALL)
        SELECT_ALL.addEventListener("click", onSelectAll);
    
    
    for (let checkbox of document.getElementsByClassName("select"))
        checkbox.addEventListener("click", onSelect);

    let temps = table.querySelectorAll("input[type='time']");
    if (temps.length > 0)
        for (let i = 0; i < temps.length; i++)
            temps[i].addEventListener("input", valider);

}






/*
    Validation, insertion des plages de temps
    dans le input sous forme de json et puis envoie.
    Si ça ne passe pas les validations, il faut
    remettre le champs "fini" à zéro.
*/
function onEnregistrer(e)
{
    let observation = document.getElementById("observation");
    let rows = Array.from(tbody.children);
    let plagesDeTemps = [];
    let jsonPlagesDeTemps;
    

    observation.value = observation.value.trim();
    



    

    //Empaquetage des plages de temps en JSON
    for (let i = 0; i < rows.length; i++)
    {
        let row = rows[i];
        let heureDebut = row.children[1].children[0].value;
        let heureFin = row.children[2].children[0].value;
        let typeTemps = row.children[3].children[0].value;

        plagesDeTemps.push(
            {
                "heureDebut": heureDebut,
                "heureFin": heureFin,
                "typeTemps_id": typeTemps
            }
        );
    }

    jsonPlagesDeTemps = JSON.stringify(plagesDeTemps);
    
    document.getElementById("plagesDeTemps").value = jsonPlagesDeTemps;
    
    form.submit();
}



/*
    Par défaut, le input qui permet de savoir si
    la fiche est terminée est défini à 0. Lorsque
    l'on clique sur terminer, il faut mettre sa
    valeur à 1 avant l'envoie.
*/
function onTerminer(e)
{
    

    if (!valider())
    {
        fini.value = 0;
        return;
    }

    fini.value = 1;
    onEnregistrer(e);
}





function onAjouter(e)
{
    let row = rowTemplate.cloneNode(true);
    let checkbox = row.children[0].children[0];

    checkbox.addEventListener("click", onSelect);

    checkbox.checked = SELECT_ALL.checked;

    tbody.appendChild(row);

    let times = row.querySelectorAll("input[type='time']");
    times[0].addEventListener("input", valider);
    times[1].addEventListener("input", valider);

    valider();
}


function onSupprimer(e)
{
    let rows = tbody.children;

    
    let length = rows.length;
    for (let i = 0; i < length; i++)
    {
        let row = rows[i];
        let checkbox = row.children[0].children[0];

        if (checkbox.checked)
        {
            tbody.removeChild(row);
            i--;
            length--;
        }
            
    }

    SELECT_ALL.checked = false;

    valider();
}



function onSelectAll(e)
{
    let checkboxes = document.getElementsByClassName("select");

    for (let i = 0; i < checkboxes.length; i++)
        checkboxes[i].checked = SELECT_ALL.checked;
}

function onSelect(e)
{
    SELECT_ALL.checked = false;
}








function valider(e = null)
{
    let rows = Array.from(tbody.children);

    /*
        Empêche de retrier si l'utilisateur
        est en train de modifier des valeurs
        
        C'est à cause que la fonction est à la fois
        un événement input et une fonction appelée
        dans le code. 
    */
    if (!e)
        retrier(rows);
    else
    {
        e.target.style.backgroundColor = NO_ERROR_COLOR;



        //Cacher les erreurs serveur une fois que l'utilisateur commence à modifier
        let serverErrors = document.getElementsByClassName("server-error");
        if (serverErrors && serverErrors.length > 0)
        {
            serverErrors = Array.from(serverErrors);
            for (let i = 0; i < serverErrors.length; i++)
            {
                let serverError = serverErrors[i];
                serverError.classList.add("d-none");
            }
        } 
    }




    for (let i = 0; i < rows.length; i++)
    {
        let times = rows[i].querySelectorAll("input[type='time']");
        times[0].style.backgroundColor = NO_ERROR_COLOR;
        times[1].style.backgroundColor = NO_ERROR_COLOR;
    }

    
    
    





    let erreurChevauche = document.getElementById("erreurChevauche");
    let erreurVide = document.getElementById("erreurVide");
    let erreurTempsComplet = document.getElementById("erreurTempsComplet");
    let erreurTempsValide = document.getElementById("erreurTempsValide");

    const COMPLET = ValidationFiche.verifierTempsComplet(rows);
    const CHEVAUCHE = ValidationFiche.verifierChevauchement(rows);
    const VIDE = ValidationFiche.verifierTempsVide(rows);
    const TEMPS_15 = ValidationFiche.verifierTranche15(rows);



    if (!VIDE)
        erreurVide.classList.remove("d-none");
    else
        erreurVide.classList.add("d-none");

    if (!CHEVAUCHE)
        erreurChevauche.classList.remove("d-none");
    else
        erreurChevauche.classList.add("d-none");
    
    if (!COMPLET)
        erreurTempsComplet.classList.remove("d-none");
    else
        erreurTempsComplet.classList.add("d-none");

    if (!TEMPS_15)
        erreurTempsValide.classList.remove("d-none");
    else
        erreurTempsValide.classList.add("d-none");


    const VALIDE = CHEVAUCHE && VIDE && COMPLET && TEMPS_15;


    if (VALIDE)
        BOUTON_FINI.removeAttribute("disabled");
    else
        BOUTON_FINI.setAttribute("disabled", "");

    return VALIDE;
}

















/*
    Permet de retrier les plages de temps si c'est nécessaire.
*/
function retrier(rows)
{
    rows.sort((rowA, rowB) => {

        let timeA = rowA.querySelector("input[type='time']").value;
        let timeB = rowB.querySelector("input[type='time']").value;


        if (timeA === timeB)
            return 0;
        
        if (timeA === "")
            return 1;

        if (timeB === "")
            return -1;

        if (timeA > timeB)
            return 1;

        return -1;
    });

    
    while (tbody.children.length !== 0)
        tbody.removeChild(tbody.children[0]);
        
    for (let i = 0; i < rows.length; i++)
        tbody.appendChild(rows[i]);
}



