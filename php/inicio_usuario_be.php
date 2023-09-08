<?php


include 'conexion_be.php';

$Correo_Electronico = $_POST['Correo_Electronico'];
$Clave = $_POST['Clave'];

$Verificar_Ingreso = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo_Electronico= '$Correo_Electronico' 
    and Clave='$Clave' ");

if (mysqli_num_rows($Verificar_Ingreso) > 0) {
    header("location: ../Directorio.php");
    exit();
} else {
    echo '
            <script>
                alert("Usuario no existente, porfavor verifica los datos ingresados");
                window.location = "../index.php";
            </script>
        ';
    exit();
}

?>