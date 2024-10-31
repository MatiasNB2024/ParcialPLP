<?php
session_start();

if (!isset($_SESSION['results'])) {
    $_SESSION['results'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerName = $_POST['player_name'];
    $word = $_POST['word'];
    $mistakes = $_POST['mistakes'];

    $_SESSION['results'][] = [
        'name' => $playerName,
        'word' => $word,
        'mistakes' => $mistakes,
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Ahorcado</title>
    <link rel="stylesheet" href="C:\Users\mnben\Parcial Paradigmas\ahorcadocss.css">
</head>
<body>
    <header>
        <h1>Resultados del Juego: El Ahorcado</h1>
    </header>

    <section class="results-container">
        <table>
            <thead>
                <tr>
                    <th>Nombre del Jugador</th>
                    <th>Palabra Adivinada</th>
                    <th>Errores Cometidos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['results'] as $result): ?>
                <tr>
                    <td><?php echo htmlspecialchars($result['name']); ?></td>
                    <td><?php echo htmlspecialchars($result['word']); ?></td>
                    <td><?php echo htmlspecialchars($result['mistakes']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="ahorcado.html">Volver al juego</a>
    </section>
</body>
</html>
