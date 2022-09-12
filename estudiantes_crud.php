<?php

if (!empty($_POST)) 
{
    $txt_id = utf8_decode($_POST["txt_id"]);
    $txt_carne = utf8_decode($_POST["txt_carne"]);
    $txt_nombres = utf8_decode($_POST["txt_nombres"]);
    $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);    
    $txt_correo = utf8_decode($_POST["txt_correo"]); 
    $txt_sangre = utf8_decode($_POST["drop_sangre"]); 
    $txt_fn = utf8_decode($_POST["txt_fn"]);

    $sql = "";

    if (isset($_POST["btn_agregar"]))
    {
        $sql = "INSERT INTO estudiantes(carne, nombres, apellidos, direccion, telefono, correo_electronico, id_tipo_sangre, fecha_nacimiento) VALUES('".$txt_carne."','".$txt_nombres."','".$txt_apellidos."','".$txt_direccion."','".$txt_telefono."','".$txt_correo."',". $txt_sangre .",'".$txt_fn."');";
    }
    if (isset($_POST["btn_modificar"]))
    {
        $sql="UPDATE estudiantes SET carne='".$txt_carne."', nombres='".$txt_nombres."', apellidos='".$txt_apellidos."', direccion='".$txt_direccion."', telefono='".$txt_telefono."', correo_electronico='".$txt_correo."', id_tipo_sangre=".$txt_sangre.", fecha_nacimiento='".$txt_fn."' WHERE id_estudiante='".$txt_id."';";
    }
    if (isset($_POST["btn_eliminar"]))
    {
        $sql ="DELETE FROM estudiantes WHERE id_estudiante='".$txt_id."';";
    }

        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
         
    
        
        if ($db_conexion->query($sql)===true){
    
            $db_conexion ->close();
            
            header('Location: /CRUD_PHP');
            
        }else{
            echo"error". $sql . "<br>".$db_conexion ->close();
        }
    

}
?>