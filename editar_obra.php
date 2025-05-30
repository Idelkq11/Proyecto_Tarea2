<?php
$codigo = $_GET['codigo'];
$obras = json_decode(file_get_contents('datos/obras.json'), true);
$obra = null;

// Buscar la obra a editar
foreach ($obras as $index => $item) {
    if ($item['codigo'] == $codigo) {
        $obra = $item;
        $obraIndex = $index;
        break;
    }
}

// Si no se encontró la obra, redirigir
if (!$obra) {
    header("Location: ver_obras.php");
    exit;
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obras[$obraIndex]['nombre'] = $_POST['nombre'];
    $obras[$obraIndex]['tipo'] = $_POST['tipo'];
    $obras[$obraIndex]['pais'] = $_POST['pais'];

    file_put_contents('datos/obras.json', json_encode($obras, JSON_PRETTY_PRINT));
    header("Location: ver_obras.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Obra</title>
</head>
<body>
    <h1>📝 Editar Obra</h1>
    <form method="post">
        <p><strong>Código:</strong> <?= htmlspecialchars($obra['codigo']) ?></p>
        <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($obra['nombre']) ?>" required></label><br><br>
        <label>Tipo: 
            <select name="tipo" required>
                <option <?= $obra['tipo'] == 'Libro' ? 'selected' : '' ?>>Libro</option>
                <option <?= $obra['tipo'] == 'Película' ? 'selected' : '' ?>>Película</option>
                <option <?= $obra['tipo'] == 'Serie' ? 'selected' : '' ?>>Serie</option>
            </select>
        </label><br><br>
        <label>País: <input type="text" name="pais" value="<?= htmlspecialchars($obra['pais']) ?>" required></label><br><br>
        <button type="submit">Guardar Cambios</button>
        <a href="ver_obras.php">Cancelar</a>
    </form>
</body>
</html>
