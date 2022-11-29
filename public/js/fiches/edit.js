let table = document.getElementById("tableModification");
let form = document.getElementById("formModification");
let rowTemplate = document.getElementById("rowTemplate");
let selectAll = document.getElementById("selectAll");

form.querySelector("button").addEventListener("click", onEnregistrer);
document.getElementById("boutonAjouter").addEventListener("click", onAjouter);
document.getElementById("boutonSupprimer").addEventListener("click", onSupprimer);
selectAll.addEventListener("click", onSelectAll);






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






function onAjouter(e)
{
    let row = rowTemplate.cloneNode(true);
    let tbody = table.children[1];

    tbody.appendChild(row);
}


function onSupprimer(e)
{
    let tbody = table.children[1];
    let rows = tbody.children;

    const length = rows.length;
    for (let i = 0; i < length; i++)
    {
        let row = rows[i];
        let checkbox = row.children[0].children[0];

        if (checkbox.checked)
        {
            tbody.removeChild(row);
            i--;
        }
            
    }
}



function onSelectAll(e)
{
    let checkBoxes = document.getElementsByClassName("select");

    for (let i = 0; i < checkBoxes.length; i++)
        checkBoxes[i].checked = selectAll.checked;
}