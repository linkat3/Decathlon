function cargafichas(data){
    let listado_articulos = document.createDocumentFragment();
    console.log(data[0]);
    for (let i=0;i<data[0].length;i++){
        let unidad = leeFichero(data[0][i]);
        listado_articulos.appendChild(unidad);
    }
    document.getElementById("listado_articulos").innerHTML = "";
    document.getElementById("listado_articulos").appendChild(listado_articulos);
}

//Carga cada uno de los cards
function leeFichero(articulo) {
    //Definiciones
    //Contenido de la columna
    let contenido = document.createElement("div");
    contenido.classList.add("col", "d-flex", "justify-content-center");
  
    //Tarjeta
    let tarjeta = document.createElement("div");
    tarjeta.classList.add("card", "d-flex");
    tarjeta.style = "width: 20rem";
  
    //Foto
    let imagen = document.createElement("img");
    imagen.classList.add("card-img-top");
    imagen.src = `./imagenes/${articulo.codigo}.jpg`;
    imagen.alt = "Card image cap";
    imagen.onerror = function (event) {
      control(event.target);
    };
  
    //Cuerpo de la tarjeta
    let cuerpo = document.createElement("div");
    cuerpo.classList.add("card-body");
  
    //Titulo
    let titulo = document.createElement("h5");
    titulo.classList.add("card-title");
    titulo.innerText = `Codigo:${articulo.codigo}`;
  
    //Texto
    const aOmitir = ["id"];
    let datos = document.createDocumentFragment();
    for (propiedad in articulo) {
      if (!aOmitir.includes(propiedad)) {
        let texto = document.createElement("p");
        texto.classList.add("card-text");
        texto.innerHTML = `<strong>${propiedad}:</strong>${articulo[propiedad]}`;
        datos.appendChild(texto);
      }
    }
  
    //Boton Modificar
    let formulario = document.createElement("form");
    formulario.action = "ficha.php";
    formulario.method = "post";
    for (propiedad in articulo) {
        let campo = document.createElement("input");
        campo.value = articulo[propiedad]
        campo.name = propiedad;
        campo.type = "hidden"
        formulario.appendChild(campo);
    }
       
    let modificar = document.createElement("input");
    modificar.type = "submit";
    modificar.classList.add( "btn", "btn-primary","w-45","mx-4","my-2");
    modificar.value = "Modificar";
    formulario.appendChild(modificar);


    //Boton Eliminar
    let eliminar = document.createElement("input");
    eliminar.type = "button";
    eliminar.classList.add( "btn", "btn-primary","w-45","mx-3","my-2");
    eliminar.value = "Eliminar";
    eliminar.addEventListener('click', () => {
      eliminararticulo(articulo.codigo,articulo.articulo);
    });
    formulario.appendChild(eliminar);
  
    // Armado y carga de la tarjeta
    tarjeta.appendChild(imagen);
    cuerpo.appendChild(titulo);
    cuerpo.appendChild(datos);
    tarjeta.appendChild(cuerpo);
    tarjeta.appendChild(formulario);
    contenido.appendChild(tarjeta);
    return contenido;
}

function control(event) {
  event.src = "./imagenes/nofoto.jpg";
}

function eliminararticulo(id,titulo) {
  document.getElementById("codigo").innerHTML = id;
  document.getElementById("articulo").innerHTML = titulo;
  let myModal = new bootstrap.Modal(document.getElementById("modalEliminar"), {});
  myModal.show();
}

