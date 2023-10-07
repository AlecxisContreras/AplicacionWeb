<?php
include 'conexion_be.php';

// Obtener los datos enviados desde el formulario de edición
$Id = $_POST['Id'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

// Realizar la consulta para actualizar los datos del contacto
$consulta = "UPDATE contactos SET Nombre = '$nombre', Direccion = '$direccion', Telefono = '$telefono', `Correo_Electronico` = '$correo' WHERE Id = '$Id'";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si la consulta fue exitosa
if ($resultado) {
    echo '
        <script>
            alert("Los cambios se han guardado correctamente.");
            window.location = "../Directorio.php";
        </script>
        ';
} else {
    echo '
        <script>
            alert("Error al guardar los cambios");
            window.location = "../Directorio.php";
        </script>
        ';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
