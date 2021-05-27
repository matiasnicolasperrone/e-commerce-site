<?php // Variables
include 'global/conexion.php';
include 'global/config.php';


// Obtiene codigo del producto a borrar
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
// Prepara DELETE
$miConsulta = $pdo->prepare('DELETE FROM tblproductos WHERE id = :id');
// Ejecuta la sentencia SQL
$miConsulta->execute(
	array(
    'id' => $id
	)
);
// Redireccionamos al PHP con todos los datos
header('Location: abm_productos.php');
?>