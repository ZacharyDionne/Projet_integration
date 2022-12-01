let table = document.getElementById("tableModification");
let tbody = table.querySelector("tbody");
let form = document.getElementById("formModification");
let rowTemplate = document.getElementById("rowTemplate");
let selectAll = document.getElementById("selectAll");

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

        times[0].addEventListener("input", onHeureDebutChanged);
        times[0].addEventListener("input", validateTime);
        times[0].oldValue = times[0].value;


        times[1].addEventListener("input", validateTime);
        times[1].oldValue = times[1].value;
        

    }
}







function onEnregistrer(e)
{
    let rows = tbody.children;
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


function onHeureDebutChanged(e)
{
    let rows = Array.from(tbody.children);
    let timeA = e.target;
    let row = timeA.parentNode.parentNode;
    let index = rows.indexOf(row);


    //Regarder si il est nécessaire de retrier, si non retourner
    if (index === 0)
    {
        if (index + 1 === rows.length)
        {
            return;
        }

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


function validateTime(e)
{
    let time = e.target;
    let array = time.value.split(":");

    let seconds = array[0] * 60 + array[1];

    if (seconds % 15 !== 0)
    {
        time.value = time.oldValue;
    } 
    else
    {
        time.oldValue = time.value;
    }    
}


