<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menu Lateral</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Architects+Daughter:400|Roboto:400"
    nonce="">
    <link rel="stylesheet" href="componentes/estilos.css"> 
  <script defer src="componentes/encabezado.js"></script> 
  <script defer src="libreria.js"></script>
</head>
<body>
  <!-- MENU  -->
  <!-- Contenedor -->
  <div class="container-fluid">
    <!-- Logo  -->
    <img src="./imagenes/logo_decathlon.png" style="width:300px;" alt="logo" >
    <form action="ficha.php" method="post">
      <input type="hidden" name="codigo" value="">
      <input type="hidden" name="articulo" value="">
      <input type="hidden" name="precio" value="">
      <input type="submit" value="Nuevo Articulo">
    </form>
    <form  id="busqueda" >
      <div class="d-flex flex-column align-items-end">
        <div aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" id="anterior" href="#">Anterior</a></li>
            <li class="page-item"><span id="pagina" class="page-link" >1</span></li>
            <li class="page-item"><a class="page-link"  id="siguiente" href="#">Siguiente</a></li>
            <li class="page-item"><span id="total_paginas" class="page-link" ></span></li>
          </ul>
        </div>
        <div class="mb-4 d-flex flex-column flex-sm-row">
          <select name="cod_familia" id="cod_familia">
          </select>
          <label for="filtro">Filtrar por Articulo:</label>
          <input type="text" id="filtro" name="filtro" maxlength=40>
          <input type="submit" value="Buscar">
        </div>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
</html>