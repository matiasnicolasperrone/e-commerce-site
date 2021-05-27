<?php
session_start();

if(!isset($_SESSION['usuarios_login']))	{
	header("location: index.php");
}else{


include 'global/conexion.php';
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';


?>
    <br>
    <?php if($mensaje!=""){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensaje;?>
            <a href="mostrarCarrito.php" class="badge badge-success">ver carrito</a>
    <?php }?>
    <div class="row">
    <?php
        $sentencia=$pdo->prepare("SELECT * FROM tblproductos");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);//será un array asociativo que se irá llenando con una fila cada vez que el puntero avanza dentro del bucle.
        
        foreach($listaProductos as $productos){?>
            <div class="col-3">
            <div class="card">
                
                    <img 
                    title="<?php echo $productos['nombre'];?>"
                    alt="<?php echo $productos['nombre'];?>"
                    src="<?php echo $productos['imagen'];?>"
                    class="card-img-top" src="" alt=""<?php //https://www.w3schools.com/bootstrap4/bootstrap_cards.asp?>
                    height="317px"
                    >
                    
                    <div class="card-body">
                    <span><?php echo $productos['nombre'];?></span>
                        <h5 class="card-title">$<?php echo $productos['precio'];?></h5>
                        <p class="card-text"><?php echo $productos['descripcion'];?></p>
                        
                 <form action="index.php" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($productos['id'],CODE,KEY);?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($productos['nombre'],CODE,KEY);//Cifra la información dada con el método y la clave dados, y devuelve una cadena codificada en bruto o mediante base64.?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($productos['precio'],CODE,KEY);?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,CODE,KEY);?>">
  
                            <input type="submit" value="Agregar" name="btnAccion">
							                                                
                        </form >
                        
                    </div>
                
            </div>
                
            </div>

    <?php
        }

    ?>
        
      

    </div>
</div>
<?php 

include 'templates/pie.php';
}
?>
