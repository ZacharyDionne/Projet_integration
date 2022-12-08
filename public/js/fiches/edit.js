let table = document.getElementById("tableModification");
let tbody = table.querySelector("tbody");
let form = document.getElementById("formModification");
let rowTemplate = document.getElementById("rowTemplate");
let selectAll = document.getElementById("selectAll");
let fini = document.getElementById("fini");

addEvents();






function addEvents()
{
    document.getElementById("boutonEnregistrer").addEventListener("click", onEnregistrer);
    document.getElementById("boutonTerminer").addEventListener("click", onTerminer);
    document.getElementById("boutonAjouter").addEventListener("click", onAjouter);
    document.getElementById("boutonSupprimer").addEventListener("click", onSupprimer);
    selectAll.addEventListener("click", onSelectAll);
    
    
    for (let checkbox of document.getElementsByClassName("select"))
        checkbox.addEventListener("click", onSelect);

    let rows = tbody.children;
    
    for (let i = 0; i < rows.length; i++)
    {
        let times = rows[i].querySelectorAll("input[type='time']");

        times[0].addEventListener("input", validateTime);
        times[0].addEventListener("input", onHeureDebutChanged);
        times[0].oldValue = times[0].value;

        times[1].addEventListener("input", validateTime);
        times[1].oldValue = times[1].value;
    }
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
    let rows = tbody.children;
    let plagesDeTemps = [];
    let jsonPlagesDeTemps;
    
    observation.value = observation.value.trim();
    
    //validation
    let valide = true;
    let champsrempli = true;
    let tempsNonChevauche = true;
    let pasRetourTemps = true;
    let erreurChevauche = document.getElementById("erreurChevauche");
    let erreurVide = document.getElementById("erreurVide");
    let erreurTempsRetour = document.getElementById("erreurTempsRetour");
    let erreurTempsComplet = document.getElementById("erreurTempsComplet");
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
        
    }

    valide = champsrempli && tempsNonChevauche && pasRetourTemps;

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
    





        let tempsTotal = 0;
        let tempsComplet;
        //Calculer la somme des temps
        for (let i = 0; i < rows.length; i++)
        {
            let row = rows[i];

            let heureDebut = row.children[1].children[0].value.split(":");
            let heureFin = row.children[2].children[0].value.split(":");
    
            let tempsA = heureDebut[0] * 3600 + heureDebut[1] * 60;
            let tempsB = heureFin[0] * 3600 + heureFin[1] * 60;
            
            tempsTotal += tempsB - tempsA;
        }
        tempsComplet = tempsTotal === 86340;
        valide = valide && tempsComplet;


        if (!tempsComplet)
            erreurTempsComplet.classList.remove("d-none");
        else
            erreurTempsComplet.classList.add("d-none");

        if (!valide)
        {
            fini.value = 0;
            return;
        }

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
    fini.value = 1;

    onEnregistrer(e);
}





function onAjouter(e)
{
    let row = rowTemplate.cloneNode(true);
    let checkbox = row.children[0].children[0];
    let times = row.querySelectorAll("input[type='time']");

    checkbox.addEventListener("click", onSelect);

    times[0].addEventListener("input", onHeureDebutChanged);
    times[0].addEventListener("input", validateTime);
    times[0].oldValue = times[0].value;


    times[1].addEventListener("input", validateTime);
    times[1].oldValue = times[1].value;

    checkbox.checked = selectAll.checked;

    tbody.appendChild(row);
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





/*
    Permet de retrier les plages de temps si c'est nécessaire.
*/
function onHeureDebutChanged(e)
{
    let rows = Array.from(tbody.children);
    let timeA = e.target;
    let row = timeA.parentNode.parentNode;
    let index = rows.indexOf(row);

    

    if (index === 0)
    {
        if (index + 1 === rows.length)
            return;

        let timeB = rows[index + 1].querySelector("input[type='time']");

        if (timeA.value <= timeB.value)
            return;
    }
    else if (index + 1 === rows.length)
    {
        let timeB = rows[index - 1].querySelector("input[type='time']");

        if (timeA.value >= timeB.value)
            return;
    }
    else
    {
        let timeB = rows[index + 1].querySelector("input[type='time']");

        if (timeA.value <= timeB.value)
            return;

        timeB = rows[index - 1].querySelector("input[type='time']");

        if (timeA.value >= timeB.value)
            return;
    }

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
    Empêche l'utilisateur d'entrez un
    temps entre les tranches de 15 minutes.
 */
function validateTime(e)
{
    let time = e.target;
    let array = time.value.split(":");

    let minutes = array[1];

    time.classList.remove("bg-warning");

    if (minutes % 15 != 0)
    {
        if (minutes != 59)
            time.value = time.oldValue;
    } 
    else
    {
        time.oldValue = time.value;
    }    
    console.log(minutes);
}



