let table = document.getElementById("tableModification");
let form = document.getElementById("formModification");
let rowTemplate = document.getElementById("rowTemplate");
let selectAll = document.getElementById("selectAll");

document.getElementById("boutonEnregistrer").addEventListener("click", onEnregistrer);
document.getElementById("boutonTerminer").addEventListener("click", onTerminer);
document.getElementById("boutonAjouter").addEventListener("click", onAjouter);
document.getElementById("boutonSupprimer").addEventListener("click", onSupprimer);
selectAll.addEventListener("click", onSelectAll);


for (let checkbox of document.getElementsByClassName("select"))
    checkbox.addEventListener("click", onSelect);




function onEnregistrer(e)
{
    let rows = table.querySelector("tbody").children;
    let plagesDeTemps = [];
    let jsonPlagesDeTemps;
    

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


function onTerminer(e)
{
    document.getElementById("fini").value = 1;

    onEnregistrer(e);
}





function onAjouter(e)
{
    let row = rowTemplate.cloneNode(true);
    let tbody = table.children[1];
    let checkbox = row.children[0].children[0];

    checkbox.addEventListener("click", onSelect);

    checkbox.checked = selectAll.checked;

    tbody.appendChild(row);
}


function onSupprimer(e)
{
    let tbody = table.children[1];
    let rows = tbody.children;

    
    let length = rows.length;
    for (let i = 0; i < length; i++)
    {
        let row = rows[i];
        let checkbox = row.children[0].children[0];

        console.log("row " + row + "\ncheckbox " + checkbox)
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