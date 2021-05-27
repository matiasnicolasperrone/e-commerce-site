<?php

session_start();
if(!isset($_SESSION['admin_login'])){
	
					header("location: index.php");  	
}else{

// Variables
include 'global/conexion.php';
include 'global/config.php';

// Prepara SELECT
$miConsulta = $pdo->prepare('SELECT * FROM tblproductos;');
// Ejecuta consulta
$miConsulta->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form ABM tienda</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td {
            border: 1px solid orange;
            text-align: center;
            padding: 1.3rem;
        }
        .button {
            border-radius: .5rem;
            color: white;
            background-color: orange;
            padding: 1rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <p><a class="button" href="pdo_insert_productos.php">Crear</a></p>
	<p><a class="button" href="cerrar_sesion.php">Cerrar Sesion</a></p>
    <table>
        <tr>
            <th>Código</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <td></td>
            <td></td>
        </tr>
<?php 

foreach ($miConsulta as $clave => $valor): 
?> 
        <tr>
           <td><?= $valor['id']; ?></td>
           <td><?= $valor['nombre']; ?></td>
           <td><?= "$".$valor['precio']; ?></td>
		   <td><?= $valor['descripcion']; ?></td>
           <td><img src="<?= $valor['imagen']; ?>" width="400" height="300" /></td>
           <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
           <td><a class="button" href="pdo_update_productos.php?id=<?= $valor['id'] ?>">Modificar</a></td>
           <td><a class="button" href="pdo_delete_productos.php?id=<?= $valor['id'] ?>">Borrar</a></td>
        </tr>
    <?php endforeach; }?>
    </table>
</body>
</html>
