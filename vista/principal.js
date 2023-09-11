window.onload = function() {
   cargador();
}

function cargador() {
    let datos = new FormData();
    datos.append("cod_familia",0);
    datos.append("filtro","");
    fetch("../controlador/controlador_articulos_contar.php",{
        method: "POST",
        body: datos
    })
    .then(response => response.json())
    .then(cantidad => {
        console.log(cantidad);
        console.log(cantidad[0]["cantidad"]);
        document.getElementById("total_paginas").innerHTML = "de "+Math.ceil(cantidad[0]["cantidad"]/12);
        fetch("../controlador/controlador_familias.php")
        .then(response => response.json())
        .then(familias => {
            console.log(familias);
            let lista_familias = document.getElementById("cod_familia");
            let opcion = document.createElement("option");
            opcion.value = 0;
            opcion.innerHTML = " ---- Todas ----";
            lista_familias.appendChild(opcion);
            for (let j = 0;j<familias[0].length;j++){
                let opcion = document.createElement("option");
                opcion.value = familias[0][j]["cod_familia"];
                opcion.innerHTML = familias[0][j]["familia"];
                lista_familias.appendChild(opcion);
            }
            const datos = new FormData();
            datos.append("cod_familia", 0);
            datos.append("filtro", "");
            datos.append("pagina",1);
            fetch("../controlador/controlador_articulos.php",{
                method: "POST",
                body: datos
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                cargafichas(data);
            })  
        }) 
    })       
}

document.getElementById("eliminarArticulo").addEventListener("click", () =>{
    let articulo = document.getElementById("codigo").innerText;
    const datos = new FormData();
    datos.append("codigo", articulo);
    fetch("../controlador/controlador_articulos_eliminar.php",{
        method: "POST",
        body: datos
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
    })  
})

