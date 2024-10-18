<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadsDir = 'uploads/';
    $songsJson = 'cançons.json'; // Ruta del archivo JSON

    // Verifica si es una solicitud para eliminar una canción
    if (isset($_POST['deleteSong'])) {
        // Lee el contenido actual del archivo JSON
        $currentSongs = file_exists($songsJson) ? json_decode(file_get_contents($songsJson), true) : [];

        // Filtra el arreglo para eliminar la canción que coincida con el título enviado
        $songTitleToDelete = $_POST['deleteSong'];

        // Busca la canción a eliminar
        $updatedSongs = [];
        foreach ($currentSongs as $song) {
            if ($song['title'] === $songTitleToDelete) {
                // Elimina los archivos de la canción
                if (file_exists($song['audio'])) {
                    unlink($song['audio']); // Elimina el archivo de audio
                }
                if (file_exists($song['cover'])) {
                    unlink($song['cover']); // Elimina el archivo de carátula
                }
                if (file_exists($song['gameFile'])) {
                    unlink($song['gameFile']); // Elimina el archivo de juego
                }
            } else {
                // Mantén las canciones que no se están eliminando
                $updatedSongs[] = $song;
            }
        }

        // Guarda el arreglo actualizado en el archivo JSON
        file_put_contents($songsJson, json_encode($updatedSongs, JSON_PRETTY_PRINT));

        echo "La cançó s'ha eliminat correctament!";
    } else {
        echo "Paràmetre de eliminació no trobat.";
    }
} else {
    echo "Método de solicitud no válido.";
}
