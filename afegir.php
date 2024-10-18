<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Rutas donde se guardarán los archivos subidos
    $songsJson = 'cançons.json'; // Ruta del archivo JSON
    $uploadsDir = 'uploads/'; // Directorio de carga

    // Verificar si la carpeta de destino existe, si no, crearla
    if (!is_dir($uploadsDir)) {
        if (!mkdir($uploadsDir, 0755, true)) {
            die("Error al crear el directorio de subida.");
        }
    }

    // Inicializar variables
    $audioPath = '';
    $coverPath = '';
    $gamePath = null;

    // Agregar logs para depurar errores de carga
    $logFile = 'upload_error_log.txt';  // Archivo para almacenar logs de errores
    file_put_contents($logFile, "Inicio del log de errores de subida\n", FILE_APPEND);

    // Función para manejar errores de archivo
    function handleFileError($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return "Error en el archivo. Código de error: " . $file['error'];
        }
        return null;
    }

    // Verificar y mover el archivo de audio
    if (isset($_FILES['audioFile'])) {
        $audioError = handleFileError($_FILES['audioFile']);
        if ($audioError) {
            file_put_contents($logFile, "Error en el archivo de audio: $audioError\n", FILE_APPEND);
            die("Error en el archivo de audio: $audioError");
        }

        $audioPath = $uploadsDir . basename($_FILES['audioFile']['name']);
        if (!move_uploaded_file($_FILES['audioFile']['tmp_name'], $audioPath)) {
            file_put_contents($logFile, "Error al mover el archivo de audio.\n", FILE_APPEND);
            die("Error al mover el archivo de audio.");
        }
    }

    // Verificar y mover el archivo de carátula
    if (isset($_FILES['coverFile'])) {
        $coverError = handleFileError($_FILES['coverFile']);
        if ($coverError) {
            file_put_contents($logFile, "Error en el archivo de carátula: $coverError\n", FILE_APPEND);
            die("Error en el archivo de carátula: $coverError");
        }

        $coverPath = $uploadsDir . basename($_FILES['coverFile']['name']);
        if (!move_uploaded_file($_FILES['coverFile']['tmp_name'], $coverPath)) {
            file_put_contents($logFile, "Error al mover el archivo de carátula.\n", FILE_APPEND);
            die("Error al mover el archivo de carátula.");
        }
    }

    // Manejo del archivo de juego
    if (!empty($_FILES['gameFile']['name'])) {
        $gameError = handleFileError($_FILES['gameFile']);
        if ($gameError) {
            file_put_contents($logFile, "Error en el archivo de juego: $gameError\n", FILE_APPEND);
            die("Error en el archivo de juego: $gameError");
        }

        $gamePath = $uploadsDir . basename($_FILES['gameFile']['name']);
        if (!move_uploaded_file($_FILES['gameFile']['tmp_name'], $gamePath)) {
            file_put_contents($logFile, "Error al subir el archivo de juego.\n", FILE_APPEND);
            die("Error al subir el archivo de juego.");
        }
    } elseif (!empty($_POST['gameText'])) {
        $gamePath = $uploadsDir . uniqid() . '.txt'; // Nombre único para el archivo
        if (file_put_contents($gamePath, $_POST['gameText']) === false) {
            file_put_contents($logFile, "Error al guardar el archivo de juego desde el textarea.\n", FILE_APPEND);
            die("Error al guardar el archivo de juego.");
        }
    }

    // Leer el contenido actual del archivo JSON
    $currentSongs = file_exists($songsJson) ? json_decode(file_get_contents($songsJson), true) : [];

    // Crear una nueva entrada para la canción
    $newSong = [
        'title' => trim($_POST['title']),
        'artist' => trim($_POST['artist']),
        'audio' => $audioPath,
        'cover' => $coverPath,
        'gameFile' => $gamePath
    ];

    // Agregar la nueva canción al arreglo
    $currentSongs[] = $newSong;

    // Guardar el arreglo actualizado en el archivo JSON
    if (file_put_contents($songsJson, json_encode($currentSongs, JSON_PRETTY_PRINT))) {
        header('Location: cançons.html');
        exit;
    } else {
        file_put_contents($logFile, "Error al guardar la información de la cançó en el archivo JSON.\n", FILE_APPEND);
        die("Error al guardar la información de la cançó.");
    }
} else {
    die("Método de solicitud no válido.");
}
?>
