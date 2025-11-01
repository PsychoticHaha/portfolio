<?php
/**
 * Database connection diagnostics.
 *
 * Run this page from a browser to confirm PHP can connect to the configured database.
 * Delete the file after troubleshooting and restrict access before exposing it publicly.
 */

declare(strict_types=1);

$allowedIps = [
  '127.0.0.1',
  '::1',
  $_SERVER['SERVER_ADDR'] ?? null,
];

if (!empty($_SERVER['REMOTE_ADDR'])) {
  $allowedIps[] = $_SERVER['REMOTE_ADDR'];
}



if (! in_array($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0', $allowedIps, true)) {
    http_response_code(403);
    exit('Access forbidden. Remove debug/db-connection.php when finished.');
}

require_once dirname(__DIR__) . '/loadEnv.php';

// Require the PDO bootstrap used by the app.
require_once dirname(__DIR__) . '/backend/pdo.php';

$status = [
    'connected' => false,
    'message' => 'Connection not attempted.',
    'host' => defined('DB_HOST') ? DB_HOST : (getenv('DB_HOST') ?: '—'),
    'database' => defined('DB_NAME') ? DB_NAME : (getenv('DB_NAME') ?: '—'),
];

try {
    $statement = $pdo->query('SHOW DATABASES');
    $row = $statement ? $statement->fetch(PDO::FETCH_ASSOC) : null;

    if ($row !== null) {
        $status['connected'] = true;
        $status['message'] = 'Connection successful.';
        $status['current_time'] = $row['current_time'] ?? 'unknown';
    } else {
        $status['message'] = 'Connected, but failed to run diagnostic query.';
    }
} catch (Throwable $exception) {
    $status['message'] = sprintf('Connection failed: %s', $exception->getMessage());
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Database Connection Diagnostics</title>
  <style>
    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      padding: 2rem;
      background: #f8fafc;
      color: #0f172a;
    }

    main {
      max-width: 640px;
      margin: 0 auto;
      background: #fff;
      padding: 2rem;
      border-radius: 18px;
      box-shadow: 0 20px 60px -30px rgba(15, 23, 42, .35);
    }

    h1 {
      margin-top: 0;
      font-size: 1.85rem;
    }

    dl {
      margin: 2rem 0;
      display: grid;
      gap: 0.75rem;
    }

    dt {
      font-weight: 600;
      color: #334155;
    }

    dd {
      margin: 0;
      padding: 0.25rem 0 0.75rem;
      border-bottom: 1px solid rgba(148, 163, 184, .3);
    }

    .status {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.35rem 0.85rem;
      border-radius: 999px;
      font-weight: 600;
    }

    .status--ok {
      background: rgba(34, 197, 94, .12);
      color: #15803d;
    }

    .status--fail {
      background: rgba(239, 68, 68, .12);
      color: #b91c1c;
    }

    code {
      font-family: "JetBrains Mono", "Fira Code", ui-monospace, SFMono-Regular, Menlo, Consolas, Liberation Mono, monospace;
      font-size: 0.95rem;
      background: rgba(226, 232, 240, .6);
      padding: 0.15rem 0.35rem;
      border-radius: 6px;
    }
  </style>
</head>
<body>
  <main>
    <h1>Database Connection Diagnostics</h1>

    <p class="status <?= $status['connected'] ? 'status--ok' : 'status--fail'; ?>">
      <?= htmlspecialchars($status['message'], ENT_QUOTES, 'UTF-8'); ?>
    </p>

    <dl>
      <div>
        <dt>Host</dt>
        <dd><code><?= htmlspecialchars((string) $status['host'], ENT_QUOTES, 'UTF-8'); ?></code></dd>
      </div>
      <div>
        <dt>Database</dt>
        <dd><code><?= htmlspecialchars((string) $status['database'], ENT_QUOTES, 'UTF-8'); ?></code></dd>
      </div>
      <?php if (isset($status['current_time'])) : ?>
        <div>
          <dt>Server Time</dt>
          <dd><code><?= htmlspecialchars($status['current_time'], ENT_QUOTES, 'UTF-8'); ?></code></dd>
        </div>
      <?php endif; ?>
    </dl>

    <p style="color:#64748b;font-size:0.9rem;">
      Remove <code>debug/db-connection.php</code> when you are done debugging.
    </p>
  </main>
</body>
</html>
