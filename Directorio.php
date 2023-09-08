<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Directorio</title>

  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/stylesDirectorio.css">

</head>

<body>
  <h1>Directorio</h1>
  <button id="mostrarFormulario">Ingresar nuevo contacto</button>

  <div id="nuevoContactoModal" class="modal">
    <div class="modal-content">
      <span class="close" id="cerrarModal">&times;</span>
      <h2>Ingresar nuevo contacto</h2>
      <form method="POST" action="php/ingresar_contacto.php">
        <input type="text" placeholder="Nombre" name="Nombre">
        <input type="text" placeholder="Direccion" name="Direccion">
        <input type="text" placeholder="Telefono" name="Telefono">
        <input type="text" placeholder="Correo_Electronico" name="Correo_Electronico">
        <button type="submit">Guardar</button>
      </form>
    </div>
  </div>


  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo_Electronico</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
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

      $consulta = "SELECT Id, Nombre, Direccion, Telefono, `Correo_Electronico` FROM contactos";
      $resultado = mysqli_query($conexion, $consulta);

      if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
          echo "<tr>";
          echo "<td>" . $fila['Id'] . "</td>";
          echo "<td>" . $fila['Nombre'] . "</td>";
          echo "<td>" . $fila['Direccion'] . "</td>";
          echo "<td>" . $fila['Telefono'] . "</td>";
          echo "<td>" . $fila['Correo_Electronico'] . "</td>";
          echo '<td class="actions">';
          echo '<form method="POST" action="php/editar_contacto.php">';
          echo '<input type="hidden" name="Id" value="' . $fila['Id'] . '">';
          echo '<button type="submit" class="icon-button" name="editar"><i class="fas fa-edit"></i></button>';
          echo '</form>';
          echo '<form method="POST" action="php/eliminar_contacto.php">';
          echo '<input type="hidden" name="Id" value="' . $fila['Id'] . '">';
          echo '<button type="submit" class="icon-button" name="eliminar"><i class="fas fa-trash-alt"></i></button>';
          echo '</form>';
          echo '</td>';
          echo "</tr>";
        }

        mysqli_free_result($resultado);
      } else {
        echo '
        <script>
            alert("Error al realizar la consulta");
            window.location = "../Directorio.php";
        </script>
        ';
      }

      mysqli_close($conexion);
      ?>
    </tbody>
  </table>

  <button id="Regresar">Regresar</button>

  <div id="mensaje"></div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script>
    document.getElementById("Regresar").addEventListener("click", function () {
      window.location.href = "index.php";
    });
    document.addEventListener("DOMContentLoaded", function () {
      const mostrarFormularioBtn = document.getElementById("mostrarFormulario");
      const nuevoContactoModal = document.getElementById("nuevoContactoModal");
      const cerrarModal = document.getElementById("cerrarModal");

      mostrarFormularioBtn.addEventListener("click", function () {
        nuevoContactoModal.style.display = "block";
      });

      cerrarModal.addEventListener("click", function () {
        nuevoContactoModal.style.display = "none";
      });
    });
  </script>


</body>

</html>