<?php
$codigo = $_GET['codigo'];

$obras = json_decode(file_get_contents('datos/obras.json'), true);
$personajes = json_decode(file_get_contents('datos/personajes.json'), true);


$obras = array_filter($obras, function($obra) use ($codigo) {
    return $obra['codigo'] !== $codigo;
});


$personajes = array_filter($personajes, function($personaje) use ($codigo) {
    return $personaje['obra_codigo'] !== $codigo;
});


file_put_contents('datos/obras.json', json_encode(array_values($obras), JSON_PRETTY_PRINT));
file_put_contents('datos/personajes.json', json_encode(array_values($personajes), JSON_PRETTY_PRINT));

header("Location: ver_obras.php");
exit;
