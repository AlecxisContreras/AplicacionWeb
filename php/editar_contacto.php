<?php
$conexion = mysqli_connect("localhost", "root", "", "aplicacionweb");

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo '
        <script>
            alert("Error al conectar con la base de datos");
            window.location = "../Directorio.php";
        </script>
        ';
    exit();
}

// Obtener el código del contacto a editar
$Id = $_POST['Id'];

// Realizar la consulta para obtener los datos del contacto
$consulta = "SELECT * FROM contactos WHERE Id = '$Id'";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Obtener los datos del contacto
    $contacto = mysqli_fetch_assoc($resultado);

    // Mostrar el formulario de edición con los datos del contacto
    echo '<form method="POST" action="guardar_edicion.php">';
    echo '<input type="hidden" name="Id" value="' . $contacto['Id'] . '">';
    echo 'Nombre: <input type="text" name="nombre" value="' . $contacto['Nombre'] . '"><br>';
    echo 'Dirección: <input type="text" name="direccion" value="' . $contacto['Direccion'] . '"><br>';
    echo 'Teléfono: <input type="text" name="telefono" value="' . $contacto['Telefono'] . '"><br>';
    echo 'Correo Electrónico: <input type="text" name="correo" value="' . $contacto['Correo_Electronico'] . '"><br>';
    echo '<button type="submit">Guardar cambios</button>';
    echo '</form>';

    // Liberar memoria
    mysqli_free_result($resultado);
} else {
    echo '
        <script>
            alert("Error al realizar la consulta");
            window.location = "../Directorio.php";
        </script>
        ';
}

// Cerrar la conexión
mysqli_close($conexion);
?>