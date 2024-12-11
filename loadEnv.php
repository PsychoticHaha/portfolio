<?php
function loadEnv($filePath = '.env') {
    if (!file_exists($filePath)) {
        throw new Exception("The .env file does not exist.");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignore comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Split key and value
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Set environment variable
        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}

// Appeler la fonction
loadEnv();

?>