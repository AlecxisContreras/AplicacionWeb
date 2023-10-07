<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibe los datos del formulario
    $Nombre = $_POST["Nombre"];
    $Direccion = $_POST["Direccion"];
    $Telefono = $_POST["Telefono"];
    $Correo_Electronico = $_POST["Correo_Electronico"];

    // Conecta a la base de datos
   include 'conexion_be.php';

    // Prepara la consulta SQL para insertar el nuevo contacto
    $consulta = "INSERT INTO contactos (Nombre, Direccion, Telefono, Correo_Electronico) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $consulta);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincula los parámetros y ejecuta la consulta
        mysqli_stmt_bind_param($stmt, "ssss", $Nombre, $Direccion, $Telefono, $Correo_Electronico);

        if (mysqli_stmt_execute($stmt)) {
            // Éxito: el contacto se ha ingresado correctamente
            echo '
                <script>
                    alert("El contacto se ha ingresado correctamente");
                    window.location = "../Directorio.php";
                </script>
                ';
        } else {
            // Error al ejecutar la consulta
            echo '
                <script>
                    alert("Error al ingresar el nuevo contacto");
                    window.location = "../Directorio.php";
                </script>
            ';
        }

        // Cierra la consulta preparada
        mysqli_stmt_close($stmt);
    } else {
        echo '
            <script>
                alert("Eror al preparar la consulta");
                window.location = "../Directorio.php";
            </script>
        ';
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Método de solicitud incorrecto
    $respuesta = [
        "success" => false,
        "message" => "Método de solicitud incorrecto."
    ];
    echo json_encode($respuesta);
}
?>
