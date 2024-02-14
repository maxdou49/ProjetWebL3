function lister()
{
    let id = document.querySelector("#type").value;
    fetch("api_type/"+id, {
        method: "GET"
    }).then(function(response) {
        if(!response.ok)
        {
            throw new Error("HTTP Error, status = "+response.status);
        }
        return response.json();
    } ).then(function(json)
    {
        let tab = document.querySelector("#liste");
        tab.innerHTML = "<tr><th>Nom</th><th>Taille</th><th>Poids</th></tr>";
        for(let elt of json)
        {
            tr = document.createElement("tr");
            td = document.createElement("td");
            td.appendChild(document.createTextNode(elt["nom"]));
            tr.appendChild(td);
            td = document.createElement("td");
            td.appendChild(document.createTextNode(elt["taille"]));
            tr.appendChild(td);
            td = document.createElement("td");
            td.appendChild(document.createTextNode(elt["poids"]));
            tr.appendChild(td);
            tab.appendChild(tr);
        }
    });
}