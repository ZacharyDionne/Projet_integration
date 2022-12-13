import { Binary } from "./Binary.js";

const ERROR_COLOR = "#ff9c9c";

export class ValidationFiche {




    static verifierTempsVide(rows)
    {
        let valide = true;

        for (let i = 0; i < rows.length; i++)
        {
            const ROW = rows[i];

            const HEURE_DEBUT = ROW.querySelector("input[type='time']");
            const HEURE_FIN = ROW.querySelectorAll("input[type='time']")[1];

            if (HEURE_DEBUT.value === "")
            {
                valide = false;
                HEURE_DEBUT.style.backgroundColor = ERROR_COLOR;
            }

            if (HEURE_FIN.value === "")
            {
                valide = false;
                HEURE_FIN.style.backgroundColor = ERROR_COLOR;
            }
        }


        return valide;
    }




    static verifierChevauchement(rows)
    {
        let valide = true;

        for (let i = 0; i < rows.length; i++)
        {
            let row = rows[i];
            let tempsDebut = row.querySelector("input[type='time']");
            let tempsFin = row.querySelectorAll("input[type='time']")[1];

            if (tempsDebut.value !== "" && tempsFin.value !== "")
            {
                if (ValidationFiche.#TimeSmaller(tempsFin.value, tempsDebut.value))
                {
                    valide = false;
                    tempsFin.style.backgroundColor = ERROR_COLOR;
                }

                if (i + 1 !== rows.length)
                {
                    let prochainTempsDebut = rows[i + 1].querySelector("input[type='time']");

                    if (prochainTempsDebut.value !== "" && ValidationFiche.#TimeSmaller(prochainTempsDebut.value, tempsFin.value))
                    {
                        valide = false;
                        prochainTempsDebut.style.backgroundColor = ERROR_COLOR;
                    }
                }
            }
        }

        return valide;
    }



    static verifierTranche15(rows)
    {
        const REGEX_LAST = /^23:59(:00)?$/;
        const REGEX_15 = /^..:(00|15|30|45)(:00)?$/;
        let valide = true;
        for (let i = 0; i < rows.length; i++)
        {
            let row = rows[i];

            let heureDebut = row.querySelector("input[type='time']");
            let heureFin = row.querySelectorAll("input[type='time']")[1];

            if (heureDebut.value !== '')
            {
                if (!REGEX_15.test(heureDebut.value))
                {
                    valide = false;
                    heureDebut.style.backgroundColor = ERROR_COLOR;
                }
            }


            if (heureFin.value !== '')
            {
                if (!REGEX_15.test(heureFin.value))
                {
                    if (i + 1 !== rows.length)
                    {
                        valide = false;
                        heureFin.style.backgroundColor = ERROR_COLOR;
                    }
                    else if (!REGEX_LAST.test(heureFin.value))
                    {
                        valide = false;
                        heureFin.style.backgroundColor = ERROR_COLOR;
                    }  
                }
            }
            
                
        }


        return valide;
    }



    static verifierTempsComplet(rows)
    {
        const MINUTES = new Binary(1440);
        const REGEX_MIDNIGHT = /^00:00(:00)?$/;

        for (let i = 0; i < rows.length; i++)
        {
            let row = rows[i];

            let heureDebut = row.querySelector("input[type='time']");
            let heureFin = row.querySelectorAll("input[type='time']")[1];

            if (heureDebut.value === '' || heureFin.value === '')
                return false;

            if (i + 1 === rows.length)
            {
                if (REGEX_MIDNIGHT.test(heureFin.value))
                    heureFin.value = '23:59:00';
            }
            else
            {
                if (ValidationFiche.#TimeSmaller(heureFin.value, heureDebut.value))
                    return false;
            }
            

            
                

            
            let debut = heureDebut.value;
            debut = debut.split(":");
            debut = parseInt(debut[0]) * 60 + parseInt(debut[1]);


            let fin = heureFin.value;
            fin = fin.split(":");
            fin = parseInt(fin[0]) * 60 + parseInt(fin[1]);


            for (let i = 0; i < MINUTES.length; i++)
            {
                if (MINUTES.get(i) === 1n)
                    continue;

                if (i >= debut && i <= fin)
                    MINUTES.set(i, 1n);
            }
            
        }

        for (let i = 0; i < MINUTES.length; i++)
        {
            if (MINUTES.get(i) === 0n)
                return false;
        }

        return true;
    }


    

    static #TimeSmaller(timeA, timeB)
    {
        let valueA = timeA.split(":");
        let valueB = timeB.split(":");

        valueA = parseInt(valueA[0]) * 60 + parseInt(valueA[1]);
        valueB = parseInt(valueB[0]) * 60 + parseInt(valueB[1]);

        return valueA < valueB;
    }
    

}