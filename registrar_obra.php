<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obra = [
        "codigo" => $_POST["codigo"],
        "foto_url" => $_POST["foto_url"],
        "tipo" => $_POST["tipo"],
        "nombre" => $_POST["nombre"],
        "descripcion" => $_POST["descripcion"],
        "pais" => $_POST["pais"],
        "autor" => $_POST["autor"]
    ];

   
    $rutaArchivo = __DIR__ . "/datos/obras.json";

    $obras = [];
    if (file_exists($rutaArchivo)) {
        $contenido = file_get_contents($rutaArchivo);
        $obras = json_decode($contenido, true);
    }

   
    $obras[] = $obra;

  
    file_put_contents($rutaArchivo, json_encode($obras, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

   
    header("Location: ver_obras.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Obra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
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
    </style>
</head>
<body>
<div class="form-container">
    <h2>Registrar Obra</h2>
    <form action="registrar_obra.php" method="POST">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo" required>

        <label for="foto_url">URL de la imagen:</label>
        <input type="text" name="foto_url" id="foto_url" required>

        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required>
            <option value="">-- Selecciona --</option>
            <option value="Serie">Serie</option>
            <option value="Película">Película</option>
            <option value="Libro">Libro</option>
            <option value="Otro">Otro</option>
        </select>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>

        <label for="pais">País:</label>
        <input type="text" name="pais" id="pais" required>

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" required>

        <button type="submit">Registrar Obra</button>
    </form>
</div>
</body>
</html>

