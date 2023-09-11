<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="ficha.css">
</head>

<body>
    <div class="d-flex justify-content-center mt-3">
        <div class="card text-dark bg-light mb-3 border-primary mb-3" style="width: 500px;">
            <form id="ficharticulo" method="post" enctype="multipart/form-data">
                <input type="hidden" name="codigo" id="codigo" value=<?php echo $_POST["codigo"] ?>>
                <div><img class="card-img-top d-flex justify-content-center caratula mx-0 my-0" id="imagen"
                        name="imagen">
                    <input type="file" name="cargaImagen" id="cargaImagen" class="d-flex align-items-end mx-1 my-1">
                </div>
                <div class="card-body">
                    <input type="text" class="card-title card-header h1" style="width: 400px;" id="articulo"
                        name="articulo" value="<?php echo $_POST["articulo"] ?>">
                    <!-- listados -->
                    <input type="number" id="codigo" name="codigo" disabled value=<?php echo $_POST["codigo"] ?> >

                    <div class="card-text titulo">Precio:</div>
                    <input type="text" class="card-text subtitulos" id="precio" name="precio" value=<?php echo $_POST["precio"] ?>>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <p class="mb-0 titulo">Familias</p>
                                <select name="familias" id="familias"></select>
                                <input class="btn-info" type="button" name="agregar_familia" id="agregar_familia"
                                    value="Agregar">
                                <div id=listaFamilias>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <input class="btn-info" type="submit" value="Aceptar">
                </div>
            </form>
            <!-- Respuesta modal -->
            <div class="modal fade" id="respuestaguardar" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" id="id_pelicula">Guardar</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="modal-title" id="tituloArticulo"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="ficha.js"></script>
            <script src="libreria.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                crossorigin="anonymous"></script>

</body>

</html>