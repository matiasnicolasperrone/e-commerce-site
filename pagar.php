<?php
include 'global/conexion.php';
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<?php
if($_POST){
    $total=0;
    $SID=session_id();
    $Correo=$_POST['email'];
	
  
	
	foreach ($_SESSION['CARRITO'] as $indice=>$producto){
        $total+=$producto['precio']*$producto['cantidad'];

    }
	$sql="INSERT INTO tblVentas (id, ClaveTransaccion, PaypalDatos, Fecha, Correo, Total, Status) VALUES (NULL, :ClaveTransaccion,'', NOW(), :Correo, :total, 'pendiente')";
	
    $sentencia= $pdo->prepare($sql);
	
    $sentencia->bindParam(":ClaveTransaccion",$SID);
    $sentencia->bindParam(":Correo",$Correo);
    $sentencia->bindParam(":total",$total);
    $sentencia->execute();
    $idVenta=$pdo->lastInsertId();

    foreach ($_SESSION['CARRITO'] as $indice=>$producto){
		$sql2="INSERT INTO
        tbldetalleventa (id, idVenta, idProducto, Precio, Cantidad, Descargado)
        VALUES (NULL,:idVenta, :idProducto, :Preciounitario, :Cantidad, 0);";
        $sentencia=$pdo->prepare($sql2);
        
        $sentencia->bindParam(":idVenta",$idVenta);
        $sentencia->bindParam(":idProducto",$producto['id']);
        $sentencia->bindParam(":Preciounitario",$producto['precio']);
        $sentencia->bindParam(":Cantidad",$producto['cantidad']);
        $sentencia->execute();
        
        
        



    }

    


}



?>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
<style>
        /* Media query for mobile viewport */
        @media screen and (max-width: 400px) {
            #paypal-button-container {
                width: 100%;
            }
        }
        
        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            #paypal-button-container {
                width: 250px;
            }
        }
    </style>
<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso final !</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con paypal la cantidad de:..
        <h4>
            <?php 
                echo "$".number_format($total,2);
                
            ?>
        <div id="paypal-button-container"></div>
        </h4>
    
    </p>
    
    <p>Content</p>
</div>


<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Smart Payment Buttons Integration | Responsive Buttons </title>

    
</head>

<body>
    <!-- Set up a container element for the button -->
    

    <!-- Include the PayPal JavaScript SDK -->
    

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $total;?>'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }


        }).render('#paypal-button-container');
    </script>
</body>

    
<?php 
include 'templates/pie.php';
?>