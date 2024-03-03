<?php
include 'conexion.php';

// Obtener los datos enviados por POST
$usu_usuario = $_POST['usuario'];
$usu_password = $_POST['password'];


// Preparar la consulta SQL para obtener los datos del usuario
$sentencia = $conexion->prepare("SELECT * FROM users WHERE email=?");
$sentencia->bind_param('s', $usu_usuario);
$sentencia->execute();

// Obtener el resultado de la consulta
$resultado = $sentencia->get_result();

// Verificar si se encontró un usuario con el nombre de usuario proporcionado
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
    if (password_verify($usu_password, $fila['password'])) {
        // Construir un array con los datos del usuario, incluyendo el usuario_id
        $usuarioData = array(
            'usuario_id' => $fila['id'],
            'usuario_nombre' => $fila['first_name'],
            'usuario_apellido' => $fila['last_name'],
            'usuario_email' => $fila['email'],
            'usuario_foto' => $fila['image']
           
        );

        // Devolver los datos del usuario en formato JSON
        echo json_encode($usuarioData, JSON_UNESCAPED_UNICODE);
    } 
}

// Cerrar la conexión y liberar recursos
$sentencia->close();
$conexion->close();
?>