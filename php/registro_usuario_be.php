<?php

include 'conexion_be.php';

$Nombre_Completo = $_POST['Nombre_Completo'];
$Correo_Electronico = $_POST['Correo_Electronico'];
$Usuario = $_POST['Usuario'];
$Clave = $_POST['Clave'];

$query = "INSERT INTO usuarios(Nombre_Completo, Correo_Electronico, Usuario, Clave)
            VALUES('$Nombre_Completo', '$Correo_Electronico', '$Usuario', '$Clave')";

$Verificar_CorreoElectronico = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo_Electronico= '$Correo_Electronico' ");

if (mysqli_num_rows($Verificar_CorreoElectronico) > 0) {
    echo '
            <script>
                alert("Este Correo Electronico ya esta ingresado, intentelo con otro diferente");
                window.location = "../index.php";
            </script>
        ';
    exit();
}

$Verificar_Usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario= '$Usuario' ");

if (mysqli_num_rows($Verificar_Usuario) > 0) {
    echo '
            <script>
                alert("Este Usuario ya esta ingresado, intentelo con otro diferente");
                window.location = "../index.php";
            </script>
        ';
    exit();
}


$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "../index.php";
            </script>
        ';
} else {
    echo '
            <script>
                alert("Intentelo de nuevo, usuario no almacenado");
                window.location = "../index.php";
            </script>
        ';
}

mysqli_close($conexion);

?>