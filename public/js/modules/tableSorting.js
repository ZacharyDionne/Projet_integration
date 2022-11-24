export class TableSorting
{
    static #tableSearch;


    static init(searchBar, tableSearch)
    {
        searchBar.addEventListener("input", TableSorting.#onInput);

        TableSorting.#tableSearch = tableSearch;
    }
    static #onInput(e) {
        let input, filter, tr;
        input = e.target;
        filter = input.value.toUpperCase();
        tr = TableSorting.#tableSearch.getElementsByTagName("tr");
    
        // Loop through all table rows, and hide those who don't match the search query
        for (let i = 0; i < tr.length; i++) 
        {
            let nom = tr[i].getElementsByTagName("td")[0];
            let matricule = tr[i].getElementsByTagName("td")[1];
            
                if (nom.innerText.toUpperCase().indexOf(filter) > -1 || matricule.innerText.toUpperCase().indexOf(filter) > -1) 
                {
                    tr[i].style.display = "";
                } 
                else 
                {
                    tr[i].style.display = "none";
                }
        }   
    }
}