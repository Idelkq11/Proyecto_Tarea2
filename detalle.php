<?php
function calcularEdad($fechaNacimiento) {
    $hoy = new DateTime();
    $nacimiento = new DateTime($fechaNacimiento);
    return $hoy->diff($nacimiento)->y;
}

function obtenerSignoZodiacal($fechaNacimiento) {
    $dia = (int)date('d', strtotime($fechaNacimiento));
    $mes = (int)date('m', strtotime($fechaNacimiento));

    $signos = [
        'Capricornio', 'Acuario', 'Piscis', 'Aries', 'Tauro', 'Géminis',
        'Cáncer', 'Leo', 'Virgo', 'Libra', 'Escorpio', 'Sagitario'
    ];
    $limites = [20, 19, 21, 20, 21, 21, 23, 23, 23, 23, 23, 22];

    if ($dia < $limites[$mes - 1]) {
        $indice = $mes - 1;
    } else {
        $indice = $mes % 12; 
    }

    return $signos[$indice];
}



$obras = json_decode(file_get_contents('datos/obras.json'), true);
$personajes = json_decode(file_get_contents('datos/personajes.json'), true);

$codigo = $_GET['codigo'] ?? null;
$obra = null;

foreach ($obras as $o) {
    if (trim($o['codigo']) === trim($codigo)) {
        $obra = $o;
        break;
    }
}

if (!$obra) {
    die("Obra no encontrada.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Obra</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        img { max-width: 200px; }
        h1, h2 { margin-top: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background-color: #f2f2f2; }

        @media print {
            .no-imprimir { display: none; }
        }
    </style>
</head>
<body>
    <h1>📚 Detalle de la Obra</h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($obra['nombre']) ?></p>
    <p><strong>Tipo:</strong> <?= htmlspecialchars($obra['tipo']) ?></p>
    <p><strong>País:</strong> <?= htmlspecialchars($obra['pais']) ?></p>
    <p><strong>Autor:</strong> <?= htmlspecialchars($obra['autor'] ?? 'Desconocido') ?></p>
    <p><strong>Descripción:</strong> <?= htmlspecialchars($obra['descripcion'] ?? 'Sin descripción') ?></p>
    <p><img src="<?= htmlspecialchars($obra['foto_url']) ?>" alt="Imagen de la obra"></p>

   <h2>👥 Personajes</h2>
<table>
    <thead>
        <tr>
            <th>Foto</th> 
            <th>Nombre</th>
            <th>Edad</th>
            <th>Signo Zodiacal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personajes as $p): ?>
            <?php if (trim($p['obra_codigo']) === trim($obra['codigo'])): ?>
                <tr>
                    <td>
                        <?php if (!empty($p['foto_url'])): ?>
                            <img src="<?= htmlspecialchars($p['foto_url']) ?>" alt="Foto de <?= htmlspecialchars($p['nombre']) ?>" style="max-width: 100px;">
                        <?php else: ?>
                            Sin foto
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?></td>
                    <td><?= calcularEdad($p['fecha_nacimiento']) ?></td>
                    <td><?= obtenerSignoZodiacal($p['fecha_nacimiento']) ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>


    <div class="no-imprimir">
        <br>
        <button onclick="window.print()">🖨️ Imprimir</button>
        <br><br>
        <a href="ver_obras.php">⬅️ Volver</a>
    </div>
</body>
</html>
