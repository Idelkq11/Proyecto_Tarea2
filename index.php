
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Sistema de Registro de Obras y Personajes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,123,255,0.3);
        }
        .btn:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 12px rgba(0,86,179,0.5);
        }
        .icon {
            font-size: 24px;
            vertical-align: middle;
            margin-right: 8px;
        }
    </style>
</head>
<body>

<?php

setlocale(LC_TIME, "es_ES.UTF-8"); 


$fecha = strftime("%A, %d de %B de %Y");
echo "<h1>🎬 Sistema de Registro de Obras y Personajes</h1>";
echo "<p>Hoy es <strong>$fecha</strong></p>";
?>


<a href="registrar_obra.php" class="btn">📚 Registrar Obra</a>
<a href="agregar_personaje.php" class="btn">🧍‍♂️ Agregar Personaje</a>
<a href="ver_obras.php" class="btn">📋 Ver Obras Registradas</a>

</body>
</html>

