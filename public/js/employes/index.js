import { XmlRequest } from "../modules/XmlRequest.js";

        (function($) {
            let search = document.getElementById("search");
                search.addEventListener("input", onInput);

                function onInput(e)

                    {

                        let regex = new RegExp(e.target.value);

                        console.log(regex.test("allo"));

                    }     
        })(jQuery);
        
XmlRequest.init("employe");