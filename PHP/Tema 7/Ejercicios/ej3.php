<?php
$selected_language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'es'; // Por defecto 'es' (español)

$lang_texts = [
    'es' => 'Hola',
    'en' => 'Hello',
];

$lang_tittle = [
    'es' => 'Selecciona un idioma',
    'en' => 'Select a language',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['language'])) {
    $selected_language = $_POST['language'];

    setcookie('language', $selected_language, time() + (30 * 24 * 60 * 60), '/'); 
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="<?php echo $selected_language; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Idioma</title>
</head>
<body>
    <h1><?php echo $lang_tittle[$selected_language]; ?></h1>

    <form method="POST" action="">
        <label>
            <input type="radio" name="language" value="es" <?php echo $selected_language == 'es' ? 'checked' : ''; ?>> Español
        </label><br>
        <label>
            <input type="radio" name="language" value="en" <?php echo $selected_language == 'en' ? 'checked' : ''; ?>> English
        </label><br>

        <button type="submit">Cambiar idioma</button>
    </form>

    <h2><?php echo $lang_texts[$selected_language]; ?></h2>
</body>
</html>
