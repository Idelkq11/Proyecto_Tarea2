<?php

if (!file_exists('datos')) {
    mkdir('datos', 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $foto_url = $_POST['foto_url'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $habilidades = explode(",", $_POST['habilidades']);
    $comida_favorita = $_POST['comida_favorita'];
    $obra_codigo = $_POST['obra_codigo'];

    $personaje = [
        'cedula' => $cedula,
        'foto_url' => $foto_url,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'fecha_nacimiento' => $fecha_nacimiento,
        'sexo' => $sexo,
        'habilidades' => array_map('trim', $habilidades),
        'comida_favorita' => $comida_favorita,
        'obra_codigo' => $obra_codigo
    ];

    $archivo = 'datos/personajes.json';
    $personajes = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

    $personajes[] = $personaje;

    file_put_contents($archivo, json_encode($personajes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $mensaje = "✅ Personaje agregado correctamente.";
}

$obras = file_exists("datos/obras.json") ? json_decode(file_get_contents("datos/obras.json"), true) : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Personaje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            padding: 40px;
        }
        .formulario {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .mensaje {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="formulario">
        <h2>Registrar Personaje</h2>

        <?php if (isset($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="cedula">Cédula del personaje:</label>
            <input type="text" id="cedula" name="cedula" required>

            <label for="foto_url">Foto URL del personaje:</label>
            <input type="text" id="foto_url" name="foto_url" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="">-- Selecciona --</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>

            <label for="habilidades">Habilidades :</label>
            <input type="text" id="habilidades" name="habilidades" required>

            <label for="comida_favorita">Comida favorita:</label>
            <input type="text" id="comida_favorita" name="comida_favorita" required>

            <label for="obra_codigo">Obra relacionada:</label>
            <select id="obra_codigo" name="obra_codigo" required>
                <option value="">-- Selecciona una obra --</option>
                <?php foreach ($obras as $obra): ?>
                    <option value="<?= htmlspecialchars($obra['codigo']) ?>">
                        <?= htmlspecialchars($obra['nombre'] . " (" . $obra['tipo'] . ")") ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Agregar Personaje</button>
        </form>
    </div>
</body>
</html>
