window.onload = function() {
    let codigo = document.getElementById("codigo").value;
    document.getElementById("imagen").src = `./imagenes/${codigo}.jpg`;
    const datos = new FormData();
    datos.append("codigoArticulo", codigo);
    fetch("../controlador/controlador_familias.php")
    .then(response => response.json())
    .then(familias => {
        console.log(familias);
        for (let i=0;i<familias[0].length;i++){
            let elemento_familia = document.createElement("option");
            elemento_familia.value = familias[0][i].cod_familia;
            elemento_familia.innerHTML = familias[0][i].familia;
            document.getElementById("familias").appendChild(elemento_familia);
        }
        fetch("../controlador/controlador_familias_articulo.php",{
            method: "POST",
            body: datos
        })
        .then(response => response.json())
        .then(lista_familias => {
            console.log(lista_familias);
            for (let i=0;i<lista_familias[0].length;i++){
                let contenedor = document.createElement("div");
                contenedor.classList.add("row");
                let elemento_cod_familia = document.createElement("p");
                elemento_cod_familia.classList.add("subtitulos","visually-hidden","col","mb-0");
                elemento_cod_familia.innerHTML = lista_familias[0][i]["cod_familia"];
                contenedor.appendChild(elemento_cod_familia);
                let elemento_familia = document.createElement("p");
                elemento_familia.classList.add("subtitulos","col","mb-0","button");
                elemento_familia.innerHTML = lista_familias[0][i]["familia"];
                elemento_familia.id = lista_familias[0][i]["cod_familia"];
                elemento_familia.addEventListener('click', () => {
                    eliminarfamilia(lista_familias[0][i]["cod_familia"]);
                  });
                contenedor.appendChild(elemento_familia);
                document.getElementById("listaFamilias").appendChild(contenedor);
            }    
        }); 
    });    
 }

 document.getElementById("imagen").addEventListener("error",(event)=>{
    control(event.target);
 })

 document.getElementById("cargaImagen").addEventListener("change",()=>{
    document.getElementById('imagen').src = window.URL.createObjectURL(document.getElementById('cargaImagen').files[0]);
 })

 document.getElementById("ficharticulo").addEventListener("submit", (event)=>{
    event.preventDefault();
    let datos = new FormData(event.target);
    for (const pair of datos) {
        console.log(`${pair[0]} - ${pair[1]}`);
    }
    if (datos.get("codigo") == "") {
        //Aqui vamos a agregar los datos de un nuevo articulo incluyendo la imagen
        fetch("../controlador/controlador_articulos_agregar.php",{
            method: "POST",
            body: datos
        })
        .then(response => response.json())
        .then(respuesta => {
            console.log(respuesta);
            console.log(JSON.parse(respuesta[0]).id);
            //leo los codigos de las categorias y los guardo en un string separados por coma
            //hay que buscar en todos los p que estan dentro de id_categoria
            let listaFamilias = document.getElementById("listaFamilias").querySelectorAll("div");
            let lista = [].slice.call(listaFamilias);
            let stringFamilias = lista.map(function(e) { return e.innerText.substring(0,e.innerText.search('\n'))}).join(",");
            console.log(JSON.parse(respuesta[0]).codigo,stringFamilias);
            let datosFamilias = new FormData();
            console.log("Articulo NRo:",JSON.parse(respuesta[0]).codigo);
            datosFamilias.append("codigo",JSON.parse(respuesta[0]).codigo);
            datosFamilias.append("familias",stringFamilias);
            fetch("../controlador/controlador_familias_articulo_agregar.php",{
                method: "POST",
                body: datosFamilias
            })
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                document.getElementById("tituloArticulo").innerHTML = respuesta[0].respuesta;
                console.log(respuesta);
                let myModal = new bootstrap.Modal(document.getElementById("respuestaguardar"), {});
                myModal.show();
            })    
        }) 
    } else {
        //Aqui vamos a modificar los datos del articulo incluyendo la imagen
        let datos = new FormData(event.target);
        fetch("../controlador/controlador_articulos_modificar.php",{
            method: "POST",
            body: datos
        })
        .then(response => response.json())
        .then(respuesta => {
            console.log(respuesta);
            let listaFamilias = document.getElementById("listaFamilias").querySelectorAll("div");
            let codigo = document.getElementById("codigo").value;
            let lista = [].slice.call(listaFamilias);
            let stringFamilias = lista.map(function(e) { return e.innerText.substring(0,e.innerText.search('\n'))}).join(",");
            console.log(codigo,stringFamilias);
            let datosFamilias = new FormData();
            console.log("Articulo NRo:",codigo);
            datosFamilias.append("codigo",codigo);
            datosFamilias.append("familias",stringFamilias);
            fetch("../controlador/controlador_familias_articulo_agregar.php",{
                method: "POST",
                body: datosFamilias
            })
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                document.getElementById("tituloArticulo").innerHTML = respuesta[0].respuesta;
                console.log(respuesta);
                let myModal = new bootstrap.Modal(document.getElementById("respuestaguardar"), {});
                myModal.show();
            })    
        })    
    }
      
 })

 document.getElementById("agregar_familia").addEventListener("click" ,()=> {
    let listaFamilias = document.getElementById("listaFamilias").querySelectorAll("div");
    let lista = [].slice.call(listaFamilias);
    let vector = lista.map(function(e) { return e.innerText.substring(0,e.innerText.search('\n')); });
    console.log(vector);
    let familias = document.getElementById("familias");
    if (!vector.includes(familias[familias.selectedIndex].value)){
        let contenedor = document.createElement("div");
        contenedor.classList.add("row");
        let id_elemento = document.createElement("p");
        id_elemento.classList.add("subtitulos","visually-hidden","col")
        id_elemento.innerHTML = familias[familias.selectedIndex].value;
        let elemento = document.createElement("p");
        elemento.innerHTML = familias[familias.selectedIndex].innerHTML;
        elemento.classList.add("subtitulos","col","mb-0","button")
        elemento.id = familias[familias.selectedIndex].value;
        elemento.addEventListener('click', () => {
            eliminarfamilia(familias[familias.selectedIndex].value);
        });
        contenedor.appendChild(id_elemento);
        contenedor.appendChild(elemento);
        document.getElementById("listaFamilias").appendChild(contenedor);
    }    
 })

 function eliminarfamilia(aeliminar){
    console.log(document.getElementById(aeliminar).parentNode);
    document.getElementById(aeliminar).parentNode.parentNode.removeChild(document.getElementById(aeliminar).parentNode)
 }
