<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $pdo = getPdo();

    $state = isset($_GET['state']) ? trim((string) $_GET['state']) : '';
    $district = isset($_GET['district']) ? trim((string) $_GET['district']) : '';

    $query = "SELECT name, latitude, longitude, state, district, hash_code FROM shooting_ranges WHERE status = 'active'";
    $params = [];

    if ($state !== '') {
        $query .= " AND state = :state";
        $params[':state'] = $state;
    }

    if ($district !== '') {
        $query .= " AND district = :district";
        $params[':district'] = $district;
    }

    $query .= " ORDER BY state, district, name";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    $ranges = [];
    while ($row = $stmt->fetch()) {
        $lat = filter_var($row['latitude'], FILTER_VALIDATE_FLOAT);
        $lng = filter_var($row['longitude'], FILTER_VALIDATE_FLOAT);

        if ($lat === false || $lng === false) {
            continue;
        }

        $ranges[] = [
            'name' => htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'),
            'state' => htmlspecialchars($row['state'], ENT_QUOTES, 'UTF-8'),
            'district' => htmlspecialchars($row['district'], ENT_QUOTES, 'UTF-8'),
            'hash_code' => htmlspecialchars($row['hash_code'], ENT_QUOTES, 'UTF-8'),
            'lat' => (float) $lat,
            'lng' => (float) $lng,
        ];
    }

    echo json_encode([
        'data' => $ranges,
    ], JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Unable to fetch ranges at this time.',
    ]);
}
