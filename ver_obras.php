<?php
$obras = json_decode(file_get_contents('datos/obras.json'), true);
$personajes = json_decode(file_get_contents('datos/personajes.json'), true);

// Contar personajes por obra
$conteoPersonajes = [];
foreach ($personajes as $personaje) {
    $obraCodigo = trim($personaje['obra_codigo']);
    if (!isset($conteoPersonajes[$obraCodigo])) {
        $conteoPersonajes[$obraCodigo] = 0;
    }
    $conteoPersonajes[$obraCodigo]++;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Obras</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }

        a.boton {
            padding: 6px 10px;
            margin-right: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a.editar { background-color: #ffc107; }
        a.eliminar { background-color: #dc3545; }

        a.boton:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <h1>📋 Listado de Obras</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>País</th>
                <th>Cantidad de Personajes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?= htmlspecialchars($obra['nombre']) ?></td>
                    <td><?= htmlspecialchars($obra['tipo']) ?></td>
                    <td><?= htmlspecialchars($obra['pais']) ?></td>
                    <td><?= $conteoPersonajes[$obra['codigo']] ?? 0 ?></td>
                    <td>
                        <a class="boton" href="detalle.php?codigo=<?= urlencode($obra['codigo']) ?>" target="_blank">Detalle</a>
                        <a class="boton editar" href="editar_obra.php?codigo=<?= urlencode($obra['codigo']) ?>">Editar</a>
                        <a class="boton eliminar" href="eliminar_obra.php?codigo=<?= urlencode($obra['codigo']) ?>" onclick="return confirm('¿Estás segura de que quieres eliminar esta obra?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

