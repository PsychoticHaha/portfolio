<?php
function loadEnv($filePath = '.env') {
    if (!file_exists(filename: $filePath)) {
        throw new Exception(message: "The .env file does not exist.");
    }

    $lines = file(filename: $filePath, flags: FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignore comments
        if (strpos(trim(string: $line), needle: '#') === 0) {
            continue;
        }

        // Split key and value
        [$key, $value] = explode(separator: '=', string: $line, limit: 2);
        $key = trim(string: $key);
        $value = trim(string: $value);

        // Set environment variable
        putenv(assignment: "$key=$value");
        $_ENV[$key] = $value;
    }
}

// Appeler la fonction
loadEnv();

?>