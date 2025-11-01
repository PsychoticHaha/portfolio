<?php

function resolveProjectId(): ?string
{
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('/\/project\/(\d+)/', $requestUri, $matches)) {
        return $matches[1];
    }

    if (isset($_GET['id']) && $_GET['id'] !== '') {
        return preg_replace('/[^\d]/', '', $_GET['id']);
    }

    return null;
}

function loadProjectsCatalogue(): ?array
{
    $jsonFilePath = __DIR__ . '/../scripts/JSON/works.json';
    if (!file_exists($jsonFilePath)) {
        return null;
    }

    $jsonContent = file_get_contents($jsonFilePath);
    $decoded = json_decode($jsonContent, true);

    if (!is_array($decoded) || !isset($decoded['works']) || !is_array($decoded['works'])) {
        return null;
    }

    return $decoded['works'];
}

function mapProject(array $project): array
{
    return [
        'id' => $project['id'],
        'title' => $project['title'],
        'description' => $project['description'] ?? '',
        'about' => $project['about'] ?? '',
        'techno' => $project['techno'] ?? [],
        'thumbnail_path' => $project['thumbnail_path'] ?? '',
        'links' => [
            'code' => $project['github_link'] ?? '#',
            'demo' => $project['deployed_link'] ?? '#',
        ],
    ];
}

$projectId = resolveProjectId();
$catalogue = loadProjectsCatalogue();

if ($projectId === null || $catalogue === null) {
    http_response_code(404);
    return ['error' => 'not_found'];
}

$matchingProject = null;
foreach ($catalogue as $project) {
    if ((string) ($project['id'] ?? '') === (string) $projectId) {
        $matchingProject = mapProject($project);
        break;
    }
}

if ($matchingProject === null) {
    http_response_code(404);
    return ['error' => 'not_found'];
}

return $matchingProject;
