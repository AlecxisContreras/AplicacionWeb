<?php
if (isset($_POST['eliminar'])) {
    $conexion = mysqli_connect("localhost", "root", "", "aplicacionweb");

    if (mysqli_connect_errno()) {
        echo '
        <script>
            alert("Error al conectar con la base de datos");
            window.location = "../Directorio.php";
        </script>
        ';
        exit();
    }

    $id = $_POST['Id'];

    // Consulta SQL para eliminar el registro
    $consulta_eliminar = "DELETE FROM contactos WHERE Id = $id";

    if (mysqli_query($conexion, $consulta_eliminar)) {
        echo '
            <script>
                alert("Registro eliminado correctamente.");
                window.location = "../Directorio.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Error al eliminar el registro");
                window.location = "../Directorio.php";
            </script>
        ';
    }

    mysqli_close($conexion);
}
?>