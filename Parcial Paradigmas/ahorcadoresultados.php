<?php
session_start();

// Lista de palabras para el juego
$palabras = ["programacion", "computadora", "desarrollo", "tecnologia", "software"];

// Si no hay una palabra seleccionada, seleccionamos una aleatoria
if (!isset($_SESSION['palabra'])) {
    $indice = array_rand($palabras);
    $_SESSION['palabra'] = $palabras[$indice];
    $_SESSION['letras_adivinadas'] = [];
    $_SESSION['intentos'] = 6; // Intentos máximos
}

// Función para mostrar la palabra oculta con las letras adivinadas
function mostrarPalabra() {
    $palabra = $_SESSION['palabra'];
    $letras_adivinadas = $_SESSION['letras_adivinadas'];
    $resultado = "";

    for ($i = 0; $i < strlen($palabra); $i++) {
        if (in_array($palabra[$i], $letras_adivinadas)) {
            $resultado .= $palabra[$i] . " ";
        } else {
            $resultado .= "_ ";
        }
    }
    return $resultado;
}

// Procesar la letra ingresada por el usuario
if (isset($_POST['letra'])) {
    $letra = strtolower(trim($_POST['letra']));

    // Verificar si la letra ya fue adivinada
    if (!in_array($letra, $_SESSION['letras_adivinadas'])) {
        $_SESSION['letras_adivinadas'][] = $letra;

        // Verificar si la letra está en la palabra
        if (strpos($_SESSION['palabra'], $letra) === false) {
            $_SESSION['intentos']--; // Reducir intentos si la letra no está
        }
    }
}

// Verificar si el juego ha terminado
$estado_juego = "";
if ($_SESSION['intentos'] <= 0) {
    $estado_juego = "¡Has perdido! La palabra era: " . $_SESSION['palabra'];
    session_destroy(); // Reiniciar el juego
} elseif (count(array_diff(str_split($_SESSION['palabra']), $_SESSION['letras_adivinadas'])) === 0) {
    $estado_juego = "¡Has ganado!";
    session_destroy(); // Reiniciar el juego
}

// Mostrar la palabra y el estado del juego
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Ahorcado</title>
    <link rel="stylesheet" href="cssahorcado/style.css">
</head>
<body>
    <h1>Juego del Ahorcado</h1>
    <div>
        <p>Palabra: <?= mostrarPalabra(); ?></p>
        <p>Intentos restantes: <?= $_SESSION['intentos']; ?></p>
        <form method="POST">
            <label for="letra">Ingresa una letra:</label>
            <input type="text" name="letra" id="letra" maxlength="1" required>
            <button type="submit">Adivinar</button>
        </form>
        <p><?= $estado_juego; ?></p>
    </div>
</body>
</html>
