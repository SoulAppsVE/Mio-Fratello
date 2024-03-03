<?php
include 'conexion.php';

// Función para formatear los resultados de productos
function formatProduct($fila) {
    // Verificar si producto_foto está vacío
    if (empty($fila['image'])) {
        // Asignar la ruta por defecto si está vacío
        $fila['image'] = 'http://192.168.0.108/Fratello/public/uploads/products/default.png';
    } else {
        // Agregar un texto adicional al campo producto_foto
        $fila['image'] = 'http://192.168.0.108/Fratello/public/uploads/products/' . $fila['image'];
    }
    $fila['mrp'] .= " USD";
    $fila['opening_stock'] .= " disponibles";

    return $fila;
}

// Web service productos_por_categoria
$consulta = $conexion->prepare("SELECT products.*, categories.category_name 
                                FROM products 
                                INNER JOIN categories ON products.category_id = categories.id 
                                WHERE products.category_id = ?");
$consulta->bind_param('i', $categoriaId);
$consulta->execute();
$resultado = $consulta->get_result();

$productos = array();

while ($fila = $resultado->fetch_assoc()) {
    $productos[] = formatProduct($fila);
    // También agregar el producto a la categoría "TODOS" con su categoria_id original
    $productosTODOS[] = formatProduct($fila);
}

$resultado->close();
$consulta->close();

// Web service cargar_categoria
$consulta = $conexion->prepare("SELECT category_name, id FROM categories");
$consulta->execute();
$consulta->bind_result($categoria_nombre, $categoria_id);

$categorias = array();

// Agregar la categoría "TODOS" al inicio del array
$categorias[] = array('category_name' => 'TODOS', 'category_id' => '0');

while ($consulta->fetch()) {
    // Agregar las demás categorías al array
    $temp = array('category_name' => $categoria_nombre, 'category_id' => $categoria_id);
    $categorias[] = $temp;
}

$consulta->close();

// Agregar los productos obtenidos por la categoría "TODOS" al array de productos
if (isset($productosTODOS)) {
    $productos = array_merge($productos, $productosTODOS);
}

// Web service buscar_producto
$consulta = $conexion->query("SELECT * FROM products");

while ($fila = $consulta->fetch_assoc()) {
    $productos[] = formatProduct($fila);
}

$conexion->close();

// Unir resultados en una estructura final
$finalResult = array('products' => $productos, 'categories' => $categorias);

echo json_encode($finalResult, JSON_UNESCAPED_UNICODE);

?>
