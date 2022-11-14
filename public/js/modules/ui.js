export function createSpinner()
{
    let spinner = document.createElement("div");
    spinner.setAttribute("class", "spinner-border position-absolute");
    spinner.setAttribute("role", "status");

    let span = document.createElement("span");
    span.setAttribute("class", "visually-hidden");
    span.innerText = "Chargement...";

    spinner.appendChild(span);

    return spinner;
}
