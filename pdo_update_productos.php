<?php
// Variables
include 'global/conexion.php';
include 'global/config.php';



$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
$descripcion = isset($_REQUEST['descripcion']) ? $_REQUEST['descripcion'] : null;
$precio = isset($_REQUEST['precio']) ? $_REQUEST['precio'] : null;
$imagen = isset($_REQUEST['imagen']) ? $_REQUEST['imagen'] : null;


// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $pdo->prepare('UPDATE tblproductos SET nombre = :nombre, precio = :precio, descripcion = :descripcion, imagen = :imagen WHERE id = :id');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        	array(
			'id' => $id,
            'nombre' => $nombre,
			'precio' => $precio,
            'descripcion' => $descripcion,
            'imagen' => $imagen
        	)
    );
    // Redireccionamos a Leer
    header('Location: abm_productos.php');
} else {
    // Prepara SELECT
    $miConsulta = $pdo->prepare('SELECT * FROM tblproductos WHERE id = :id;');
    // Ejecuta consulta
    $miConsulta->execute(
        array(
            'id' => $id
        )
    );
}

// Obtiene un resultado
$productos = $miConsulta->fetch();

?>
<!DOCTYPE html>
<html lang="es">
<body>
    <form method="post">
        <p>
            <label for="titulo">Producto</label>
            <input id="titulo" type="text" name="nombre" value="<?= $productos['nombre'] ?>">
        </p>
        <p>
            <label for="titulo">Precio</label>
            <input id="titulo" type="text" name="precio" value="<?= $productos['precio'] ?>">
        </p>
       
        <p>
            <label for="autor">Descripcion</label>
            <input id="autor" type="text" name="descripcion" value="<?= $productos['descripcion'] ?>">
        </p>
        <p>
            <label for="autor">Imagen</label>
            <input id="autor" type="text" name="imagen" value="<?= $productos['imagen'] ?>">
        </p>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" value="Modificar">
        </p>
    </form>
</body>
</html>
