let table = document.getElementById("tableModification");
let tbody = table.querySelector("tbody");
let form = document.getElementById("formModification");
let rowTemplate = document.getElementById("rowTemplate");
let selectAll = document.getElementById("selectAll");
let fini = document.getElementById("fini");

addEvents();
valider();





function addEvents()
{
    document.getElementById("boutonEnregistrer").addEventListener("click", onEnregistrer);
    document.getElementById("boutonTerminer").addEventListener("click", onTerminer);
    document.getElementById("boutonAjouter").addEventListener("click", onAjouter);
    document.getElementById("boutonSupprimer").addEventListener("click", onSupprimer);
    selectAll.addEventListener("click", onSelectAll);
    
    
    for (let checkbox of document.getElementsByClassName("select"))
        checkbox.addEventListener("click", onSelect);

    let temps = table.querySelectorAll("input[type='time']");
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

    checkbox.checked = selectAll.checked;

    tbody.appendChild(row);

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

    selectAll.checked = false;

    valider;
}



function onSelectAll(e)
{
    let checkboxes = document.getElementsByClassName("select");

    for (let i = 0; i < checkboxes.length; i++)
        checkboxes[i].checked = selectAll.checked;
}

function onSelect(e)
{
    selectAll.checked = false;
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
        e.target.classList.remove("bg-warning");


    let valide = true;
    let champsrempli = true;
    let tempsNonChevauche = true;
    let pasRetourTemps = true;
    let tempsValide = true;

    let erreurChevauche = document.getElementById("erreurChevauche");
    let erreurVide = document.getElementById("erreurVide");
    let erreurTempsRetour = document.getElementById("erreurTempsRetour");
    let erreurTempsComplet = document.getElementById("erreurTempsComplet");
    let erreurTempsValide = document.getElementById("erreurTempsValide");


    for (let i = 0; i < rows.length; i++)
    {
        let row = rows[i];
        let heureDebut = row.children[1].children[0];
        let heureFin = row.children[2].children[0];

        let nextRow = rows[i + 1];
        let nextHeureDebut = null;
        if (nextRow)
            nextHeureDebut = nextRow.children[1].children[0];



        if (heureDebut.value === '' )
        {
            heureDebut.classList.add("bg-warning");
            champsrempli = false;
        }
        else
            heureDebut.classList.remove("bg-warning");



        if (heureFin.value === '')
        {
            heureFin.classList.add("bg-warning");
            champsrempli = false;
        }
        else if (heureFin.value < heureDebut.value)
        {
            heureFin.classList.add("bg-warning");
            pasRetourTemps = false;
        }
        else if (nextRow)
        {
            if (nextHeureDebut.value !== '' && heureFin.value > nextHeureDebut.value)
            {
                heureFin.classList.add("bg-warning");
                tempsNonChevauche = false;
            }
            else
                heureFin.classList.remove("bg-warning");
        }
            
        

        if (!validerTemps(heureDebut))
        {
            heureDebut.classList.add("bg-warning");
            tempsValide = false;
        }

        if (!validerTemps(heureFin))
        {
            heureFin.classList.add("bg-warning");
            tempsValide = false;
        }
        
    }

    valide = champsrempli && tempsNonChevauche && pasRetourTemps && tempsValide;

    if (!champsrempli)
        erreurVide.classList.remove("d-none");
    else
        erreurVide.classList.add("d-none");

    if (!tempsNonChevauche)
        erreurChevauche.classList.remove("d-none");
    else
        erreurChevauche.classList.add("d-none");

    if (!pasRetourTemps)
        erreurTempsRetour.classList.remove("d-none");
    else
        erreurTempsRetour.classList.add("d-none");
    
    if (!tempsValide)
        erreurTempsValide.classList.remove("d-none");
    else
        erreurTempsValide.classList.add("d-none");







        if (!valide)
        {
            /*
                afficher l'erreur de temps complet de
                maniere plus approprié, puisqu'il y a beaucoup
                de temps invalides.
                
                Ne prend en compte que le premier
                et le dernier temps.
            */
            let tempsInitialValide;
            let tempsFinalValide;

            let tempsInitial = rows[0].children[1].children[0];
            let tempsFinal = rows[rows.length - 1].children[2].children[0];

            let regexTempsInitial = /^00:00(:00)?$/;
            let regexTempsFinal = /^[(23:59)(00:00)](:00)?$/;


            tempsInitialValide = regexTempsInitial.test(tempsInitial.value);
            tempsFinalValide = regexTempsFinal.test(tempsFinal.value);

            if (!tempsInitialValide)
                tempsInitial.classList.add("bg-warning");

            if (!tempsFinalValide)
                tempsFinalValide.classList.add("bg-warning");


            if (!tempsInitialValide || !tempsFinalValide)
                erreurTempsComplet.classList.remove("d-none");
            else
                erreurTempsComplet.classList.add("d-none");

            
            return false;
        }



        //Valider la somme des temps
        let regexTempsFinal = /^23:59(:00)?$/;
        if (regexTempsFinal.test(rows[rows.length - 1].children[2].children[0].value))
            rows[rows.length - 1].children[2].children[0].value = '00:00';
        
        let tempsTotal = 0;
        let tempsComplet;
        for (let i = 0; i < rows.length; i++)
        {
            let row = rows[i];

            let heureDebut = row.children[1].children[0].value.split(":");
            let heureFin = row.children[2].children[0].value.split(":");
    
            let tempsA = heureDebut[0] * 3600 + heureDebut[1] * 60;
            let tempsB = heureFin[0] * 3600 + heureFin[1] * 60;
            
            tempsTotal += tempsB - tempsA;
        }

        /*
            Vérifier si tous les minutes sont dans une plage de temps,
            avec un marche d'erreur de 1 minute, si le chauffeur
            a entrer comme dernier temps 00:00 au lieu de 23:59
        */        
        if (tempsTotal !== 86340)
            erreurTempsComplet.classList.remove("d-none");
        else
            erreurTempsComplet.classList.add("d-none");


        valide = valide && tempsComplet;
        




        if (!valide)
            return false;



        return true;
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

/*
    Vérifie si l'utilisateur entre un
    temps entre les tranches de 15 minutes en acceptant 59 minutes comme fin.
 */
function validerTemps(temps)
{
    let regex = /^([0-1][0-9]|2[0-3]):(00|15|30|45|59)(:00)?$/;
    
    return regex.test(temps.value);
}



