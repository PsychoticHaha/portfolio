<?php
require_once 'pdo.php';

header('Content-Type: application/json');

$allowedReactions = ['love', 'like', 'dislike'];

function buildStats(PDO $pdo, array $allowedReactions): array
{
    $query = 'SELECT reaction, COUNT(*) AS count FROM reactions GROUP BY reaction';
    $statement = $pdo->query($query);
    $results = $statement ? $statement->fetchAll(PDO::FETCH_ASSOC) : [];

    $counts = array_fill_keys($allowedReactions, 0);
    $total = 0;

    foreach ($results as $row) {
        $reaction = $row['reaction'];
        $count = (int) $row['count'];
        if (array_key_exists($reaction, $counts)) {
            $counts[$reaction] = $count;
            $total += $count;
        }
    }

    $stats = [
        'total' => $total,
    ];

    foreach ($counts as $reaction => $count) {
        $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
        $stats[$reaction] = [
            'count' => $count,
            'percentage' => $percentage,
        ];
    }

    return $stats;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'status' => 'ok',
        'stats' => buildStats($pdo, $allowedReactions),
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reaction = $_POST['reaction'] ?? '';
    $dateInput = $_POST['date'] ?? '';
    $date = date('Y-m-d H:i:s');

    if (!empty($dateInput)) {
        $timestamp = strtotime($dateInput);
        if ($timestamp !== false) {
            $date = date('Y-m-d H:i:s', $timestamp);
        }
    }

    if (!in_array($reaction, $allowedReactions, true)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid reaction.',
        ]);
        exit;
    }

    try {
        $sql = 'INSERT INTO reactions (reaction, date) VALUES(:reaction, :date)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':reaction', $reaction, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error.',
        ]);
        exit;
    }

    echo json_encode([
        'status' => 'saved',
        'stats' => buildStats($pdo, $allowedReactions),
    ]);
    exit;
}

http_response_code(405);
echo json_encode([
    'status' => 'error',
    'message' => 'Method not allowed.',
]);
