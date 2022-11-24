import { XmlRequest } from "../modules/XmlRequest.js";
import { TableSorting } from "../modules/tableSorting.js";
        
XmlRequest.init("employe");
TableSorting.init(document.getElementById("searchBar"), document.getElementById("tableSearch"));