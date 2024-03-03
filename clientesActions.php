<?php

include 'conexion.php';

// Verificar el método de solicitud
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        // Consulta para obtener todos los datos de la tabla cliente
        $consulta = $conexion->query("SELECT * FROM clients");

        // Verificar si la consulta fue exitosa
        if ($consulta) {
            // Almacenar los resultados en un array asociativo
            $clientes = array();

            while ($fila = $consulta->fetch_assoc()) {
                $clientes[] = $fila;
            }

            // Cerrar la consulta
            $consulta->close();

            // Devolver el resultado como JSON
            echo json_encode($clientes, JSON_UNESCAPED_UNICODE);
        } else {
            // Manejar el caso en que la consulta falló
            echo json_encode(array('error' => 'Error al obtener datos de la tabla cliente'), JSON_UNESCAPED_UNICODE);
        }
        break;

        case 'POST':
            // Operación de agregar (CREATE)
            // Asumiendo que recibes datos en formato JSON en el cuerpo de la solicitud
            $datosCliente = json_decode(file_get_contents("php://input"), true);
    
            // Validar y procesar los datos recibidos
            // ...
    
            // Ejemplo: Agregar un nuevo cliente
           
            $cliente_tipo_documento= $datosCliente['cliente_tipo_documento'];
            $cliente_numero_documento= $datosCliente['cliente_numero_documento'];
            $cliente_nombre = $datosCliente['cliente_nombre'];
            $cliente_apellido = $datosCliente['cliente_apellido'];
            $cliente_provincia= $datosCliente['cliente_provincia'];
            $cliente_ciudad= $datosCliente['cliente_ciudad'];
            $cliente_direccion= $datosCliente['cliente_direccion'];
            $cliente_telefono= $datosCliente['cliente_telefono'];
            $cliente_email= $datosCliente['cliente_email'];
            // Agregar más campos según tu estructura de tabla
    
            $insercion = $conexion->query("INSERT INTO cliente ( cliente_tipo_documento, cliente_numero_documento, cliente_nombre, cliente_apellido, cliente_provincia, cliente_ciudad, cliente_direccion, cliente_telefono, cliente_email) VALUES ('$cliente_tipo_documento','$cliente_numero_documento', '$cliente_nombre','$cliente_apellido','$cliente_provincia','$cliente_ciudad','$cliente_direccion','$cliente_telefono','$cliente_email')");
    
    
            if ($insercion) {
                echo json_encode(array('mensaje' => 'Cliente agregado exitosamente'), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array('error' => 'Error al agregar cliente'), JSON_UNESCAPED_UNICODE);
            }
    
            break;

            case 'PUT':
                // Operación de modificar (UPDATE)
                // Asumiendo que recibes datos en formato JSON en el cuerpo de la solicitud
                $datosCliente = json_decode(file_get_contents("php://input"), true);
            
                // Validar y procesar los datos recibidos
                // ...
            
                // Ejemplo: Modificar un cliente existente por ID
                $cliente_tipo_documento = $datosCliente['cliente_tipo_documento'];
                $cliente_numero_documento = $datosCliente['cliente_numero_documento'];
                $cliente_nombre = $datosCliente['cliente_nombre'];
                $cliente_apellido = $datosCliente['cliente_apellido'];
                $cliente_provincia = $datosCliente['cliente_provincia'];
                $cliente_ciudad = $datosCliente['cliente_ciudad'];
                $cliente_direccion = $datosCliente['cliente_direccion'];
                $cliente_telefono = $datosCliente['cliente_telefono'];
                $cliente_email = $datosCliente['cliente_email'];
                // Modificar más campos según tu estructura de tabla
            
                $actualizacion = $conexion->query("UPDATE cliente SET  
                cliente_tipo_documento = '$cliente_tipo_documento', 
                cliente_numero_documento = '$cliente_numero_documento', 
                cliente_nombre = '$cliente_nombre', 
                cliente_apellido = '$cliente_apellido', 
                cliente_provincia = '$cliente_provincia', 
                cliente_ciudad = '$cliente_ciudad', 
                cliente_direccion = '$cliente_direccion', 
                cliente_telefono = '$cliente_telefono', 
                cliente_email = '$cliente_email' 
                WHERE cliente_numero_documento = '$cliente_numero_documento'");
            
                if ($actualizacion) {
                    echo json_encode(array('mensaje' => 'Cliente modificado exitosamente'), JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode(array('error' => 'Error al modificar cliente'), JSON_UNESCAPED_UNICODE);
                }
            
                break;
            

        case 'DELETE':
            // Operación de eliminar (DELETE)
            // Asumiendo que recibes el ID del cliente a eliminar como parámetro
            $idClienteEliminar = $_GET['id'];
    
            // Validar y procesar el ID recibido
            // ...
    
            // Ejemplo: Eliminar un cliente por ID
            $eliminacion = $conexion->query("DELETE FROM cliente WHERE id = $idClienteEliminar");
    
            if ($eliminacion) {
                echo json_encode(array('mensaje' => 'Cliente eliminado exitosamente'), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array('error' => 'Error al eliminar cliente'), JSON_UNESCAPED_UNICODE);
            }
    
            break;
    
            default:
            // Manejar el caso en que el método de solicitud no está permitido
            echo json_encode(array('error' => 'Método no permitido'), JSON_UNESCAPED_UNICODE);
            break;
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>