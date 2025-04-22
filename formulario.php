<?php
$errores = [];
$mostrarExito = false;
$nombre = $correo = $mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"] ?? '';
    $correo = $_POST["correo"] ?? '';
    $mensaje = $_POST["mensaje"] ?? '';
    
    if (empty($nombre)) {
        $errores[] = "Por favor ingresa un nombre.";
    }
    if (empty($correo)) {
        $errores[] = "Por favor ingresa un correo.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Correo invalido.";
    }
    
    if (empty($mensaje)) {
        $errores[] = "Por favor ingresa el mensaje.";
    }
    
    if (empty($errores)) {
        $mostrarExito = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">  
        <form method="post">
            <div class="campo">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            </div>
            
            <div class="campo">
                <label>Correo:</label>
                <input type="text" name="correo" value="<?php echo htmlspecialchars($correo); ?>">
            </div>
            
            <div class="campo">
                <label>Mensaje:</label>
                <textarea name="mensaje"><?php echo htmlspecialchars($mensaje); ?></textarea>
            </div>
            <?php if ($mostrarExito): ?>
                <div class="mensaje-exito">Enviado Correctamente</div>
            <?php endif; ?>
            
            <?php if (!empty($errores)): ?>
                <div class="errores">
                    <?php foreach ($errores as $error): ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <button type="submit">Enviar Correo</button>
        </form>
    </div>
</body>
</html>