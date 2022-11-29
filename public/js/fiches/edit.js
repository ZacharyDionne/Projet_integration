document.getElementById("formModification").querySelector("button").addEventListener("click", onClick);

let table = document.getElementById("tableModification");
let form = document.getElementById("formModification");

function onClick(e)
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
