<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script defer src="./fontawesome-free-6.3.0-web/fontawesome-free-6.3.0-web/js/fontawesome.js"></script>
    <script defer src="./fontawesome-free-6.3.0-web/fontawesome-free-6.3.0-web/js/solid.js"></script>
    <script defer src="./fontawesome-free-6.3.0-web/fontawesome-free-6.3.0-web/js/brands.js"></script>
    <script defer src="principal.js"></script>
    <script defer src="libreria.js"></script>
</head>

<body>
    <?php include_once "componentes/encabezado.php";
    $permitidos = array('cuerpo', 'formulario');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 'cuerpo';
    if (in_array($page, $permitidos)) {
        include("componentes/$page.php");
    }
    ;
    ?>

    <!-- Ventana modal -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title" for="id_articulo">Desea eliminar el Articulo: </label>
                    <span class="modal-title" id="codigo"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="modal-title" for="articulo">Descripción: </label>
                    <span class="modal-title" id="articulo"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="eliminarArticulo">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "componentes/pie.php" ?>
</body>

</html>