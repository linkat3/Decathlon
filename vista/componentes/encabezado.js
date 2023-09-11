document.getElementById("busqueda").addEventListener("submit",(event)=>{
    event.preventDefault();
    event.stopPropagation();
    let datos = new FormData(document.getElementById("busqueda"));
    cargadatos(datos);
})

function cargadatos(datos){
    for (const pareja of datos) {
       console.log(`${pareja[0]} - ${pareja[1]}`);
    }
    fetch("../controlador/controlador_articulos_contar.php",{
        method: "POST",
        body: datos
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        document.getElementById("total_paginas").innerHTML = "de "+Math.ceil(data[0]["cantidad"]/12);
        console.log(Math.ceil(data[0]["cantidad"]/12));
        console.log(datos.has('anterior'));
        if (document.getElementById("pagina").innerHTML == "1" && datos.has('anterior')){
            console.log("retrocedo estando en 1");
            return;
        }
        if (document.getElementById("pagina").innerHTML == Math.ceil(data[0]["cantidad"]/12) && datos.has('siguiente')){
            console.log("adelanto estando en el ultimo");
            return;
        }
        let nueva_pagina = document.getElementById("pagina").innerHTML;
        if (datos.has('anterior')) {
            nueva_pagina--;
        }
        if (datos.has('siguiente')) {
            nueva_pagina++;
        }
        if (document.getElementById("pagina").innerHTML > Math.ceil(data[0]["cantidad"]/12)){
            nueva_pagina = 1;
        } 
        document.getElementById("pagina").innerHTML = nueva_pagina;
        datos.append("pagina",nueva_pagina);
        fetch("../controlador/controlador_articulos.php",{
            method: "POST",
            body: datos
        })
        .then(response => response.json())
        .then(peliculas => {
            cargafichas(peliculas);
        })    
    })  
}

document.getElementById("anterior").addEventListener("click", function () {
    let datos = new FormData(document.getElementById("busqueda"));
    datos.append("anterior",1);
    cargadatos(datos);
});

document.getElementById("siguiente").addEventListener("click", function () {
    let datos = new FormData(document.getElementById("busqueda"));
    datos.append("siguiente",1);
    cargadatos(datos);
});