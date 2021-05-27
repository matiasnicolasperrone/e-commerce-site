<?php
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br>
<h3>Lista del carro de compras</h3>
<?php if(!empty($_SESSION['CARRITO'])){ ?>
    <table class="table table-light table-bordered">
        <tbody>
            <tr>
                <th widht="40%">Descripcion</th>
                <th widht="15%" class="text-center">Cantidad</th>
                <th widht="20%" class="text-center">Precio</th>
                <th widht="20%" class="text-center">Total</th>
                <th widht="5%" >---</th>
            </tr>
        
    <?php $total=0;?>
    <?php foreach ($_SESSION['CARRITO'] as $indice=>$producto) {?>
            <tr>
                <td widht="40%"><?php echo $producto['nombre'];?></td>
                <td widht="15%" class="text-center"><?php echo $producto['cantidad'];?></td>
                <td widht="20%" class="text-center"><?php echo $producto['precio'];?></td>
                <td widht="20%" class="text-center"><?php echo number_format($producto['cantidad']*$producto['precio'],2) ;?></td>
                
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'],CODE,KEY);?>">
                <td widht="20%"><button 
                class="bt-danger" 
                type="submit"
                name="btnAccion"
                value="Eliminar"
                >Eliminar</button></td>
            
            
            </form>
                
                
                
                
            </tr>



            <?php $total=$total+($producto['cantidad']*$producto['precio']);?>
    <?php }?>
<?php }else{ ?>
    <div class="alert alert-success" role="alert">
        No hay productos en el carrito de compras...
    </div>

<?php }?>
<tr>
    <td colspan="3" align="right"><h3>Total</h3>
    <td align="right"><h3>$<?php echo number_format($total,2) ?></h3>

</tr>
<tr>
    <td colspan="5">
    
        <form action="pagar.php" method="post">
            <div class="alert alert-success" role="alert">
                <div class="form-group">
                    <label for="my-input">Correo de contacto:</label>
                    <input id="email" name="email" class="form-control" type="email" placeholder="Por favor escribe tu email...." required>
                    
                </div>
                    <small id="emailHelp">
                        <class="form-text text-muted">
                            Los productos se enviaran al siguiente correo:...
                        </class>
                    </small>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit" value="Proceder" name="btnAccion">Proceder a pagar>></button>
        </form> 
    
    
      
    </td>


</tr>

</tbody>
</table>

<?php 
include 'templates/pie.php';
?>
