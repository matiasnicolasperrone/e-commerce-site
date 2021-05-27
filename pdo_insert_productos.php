<?php
// Comprobamso si recibimos datos por POST
include 'global/conexion.php';
include 'global/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
    $precio = isset($_REQUEST['precio']) ? $_REQUEST['precio'] : null;
    $descripcion = isset($_REQUEST['descripcion']) ? $_REQUEST['descripcion'] : null;
	
	//establezco el directorio de los archivos
	$directorio = $_SERVER['DOCUMENT_ROOT'].'/tienda/archivos/';
    
	
	if(isset($_FILES['archivo'])){
		$subiook=$_FILES['archivo']['error']== UPLOAD_ERR_OK;
		$esImagen= getimagesize($_FILES['archivo']['tmp_name']);

		if($esImagen){
			move_uploaded_file(
				$_FILES['archivo']['tmp_name'],
				$directorio.$_FILES['archivo']['name']
			);
			$imagen='http://localhost/tienda/archivos/'.$_FILES['archivo']['name'];	
		}else{
			echo "El archivo subido no es un imagen";
	}
	
	
	
	
	}
		
	
	
    // Prepara INSERT
    $miInsert = $pdo->prepare('INSERT INTO tblproductos (nombre, precio, descripcion, imagen) VALUES (:nombre, :precio, :descripcion, :imagen)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'nombre' => $nombre,
            'precio' => $precio,
            'descripcion' => $descripcion,
			'imagen' => $imagen
        )
    );
    // Redireccionamos a Leer
    header('Location: abm_productos.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Producto</label>
            <input id="nombre" type="text" name="nombre">
        </p>
        <p>
            <label for="precio">Precio</label>
            <input id="precio" type="text" name="precio">
        </p>
        <p>
            <label for="descripcion">Descripcion</label>
            <input id="descripcion" type="text" name="descripcion">
        </p>
        <p>
            <label for="archivo">Imagen</label>
            <input id="archivo" type="file" multiple accept=".jpg,.png,.gif" name="archivo">
        </p>
  
        <p>
            <input type="submit" value="Guardar">
        </p>
    </form>
</body>
</html>
