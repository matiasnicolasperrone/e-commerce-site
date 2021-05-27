<?php
session_start();

$mensaje="";

if(isset($_POST['btnAccion'])){
    
    switch($_POST['btnAccion']){
            case 'Agregar':
                if(is_numeric(openssl_decrypt($_POST['id'],CODE,KEY))){
                    $id=openssl_decrypt($_POST['id'],CODE,KEY);
                    $mensaje.="OK ID correcto".$id."<br>";


                }else{

                    $mensaje.="ID incorrecto".$id."<br>";

                }
                if(is_string(openssl_decrypt($_POST['nombre'],CODE,KEY))){
                    $nombre.=openssl_decrypt($_POST['nombre'],CODE,KEY);
                    $mensaje.="OK nombre correcto".$nombre."<br>";


                }else{

                    $mensaje.="nombre incorrecto".$nombre."<br>";

                }  
                if(is_numeric(openssl_decrypt($_POST['cantidad'],CODE,KEY))){
                    $cantidad=openssl_decrypt($_POST['cantidad'],CODE,KEY);
                    $mensaje.="OK cantidad correcto".$cantidad."<br>";


                }else{

                    $mensaje.="cantidad incorrecto".$cantidad."<br>";

                }
                if(is_numeric(openssl_decrypt($_POST['precio'],CODE,KEY))){
                    $precio=openssl_decrypt($_POST['precio'],CODE,KEY);
                    $mensaje.="OK precio correcto".$precio."<br>";


                }else{

                    $mensaje.="precio incorrecto".$precio."<br>";

                }
                if(!isset($_SESSION['CARRITO'])){
                    $producto=array(
                        'id'=>$id,
                        'nombre'=>$nombre,
                        'cantidad'=>$cantidad,
                        'precio'=>$precio
                    );

                    $_SESSION['CARRITO'][0]=$producto;
                    $mensaje="Producto agregado al carrito de compras";

                }else{
                    $idProductos=array_column($_SESSION['CARRITO'],"id");
                        if(in_array($id,$idProductos)){
                                echo "<script>alert('El producto ya ha sido seleccionado...')</script>";



                        }else{
                            $numeroProductos=count($_SESSION['CARRITO']);
                            $producto=array(
                                'id'=>$id,
                                'nombre'=>$nombre,
                                'cantidad'=>$cantidad,
                                'precio'=>$precio
                            );
                            $_SESSION['CARRITO'][$numeroProductos]=$producto;
                            $mensaje="Producto agregado al carrito de compras";

                        }
						}
						//$mensaje=print_r($_SESSION,true);
						break;
                
                case 'Eliminar':
                    if(is_numeric(openssl_decrypt($_POST['id'],CODE,KEY))){
                        $id=openssl_decrypt($_POST['id'],CODE,KEY);
                        foreach($_SESSION['CARRITO'] as $indice=>$producto){
                            if($producto['id']==$id){
                                unset($_SESSION['CARRITO'][$indice]);
                                echo "<script>alert('Elemento eliminado')</script>";
                            }


                        }    
    
                    }else{
    
                        $mensaje.="ID incorrecto".$id."<br>";
    
                    }
                
                
                
                
                	break;




    }   


}





?>