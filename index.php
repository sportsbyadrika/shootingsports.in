<?php
require_once __DIR__ . '/config.php';

$pdo = getPdo();

$eventsStmt = $pdo->prepare('SELECT id, title, image_url, event_date, location, description FROM events ORDER BY event_date DESC LIMIT 4');
$eventsStmt->execute();
$events = $eventsStmt->fetchAll();

$statesStmt = $pdo->prepare("SELECT DISTINCT state FROM shooting_ranges WHERE status = 'active' ORDER BY state");
$statesStmt->execute();
$states = $statesStmt->fetchAll(PDO::FETCH_COLUMN);

$districtsStmt = $pdo->prepare("SELECT state, district FROM shooting_ranges WHERE status = 'active'");
$districtsStmt->execute();
$districtLookup = [];
$allDistricts = [];
while ($row = $districtsStmt->fetch()) {
    $state = $row['state'];
    $district = $row['district'];
    $districtLookup[$state][$district] = true;
    $allDistricts[$district] = true;
}
$allDistricts = array_keys($allDistricts);
ksort($districtLookup);
sort($allDistricts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShootingSports.in | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="font-[Inter] bg-gray-50 text-gray-800">
    <?php include __DIR__ . '/navbar.php'; ?>

    <header class="relative bg-cover bg-center h-[60vh] flex items-center justify-center" style="background-image: url('https://placehold.co/1600x800?text=Shooting+Sports');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center px-4">
            <p class="text-blue-200 uppercase tracking-wide mb-2">Welcome to ShootingSports.in</p>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Discover Events & Shooting Ranges Across India</h1>
            <p class="text-lg text-gray-100 max-w-3xl mx-auto">Stay updated with the latest shooting sports events and find accredited ranges near you with interactive mapping and detailed filters.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
        <section>
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-blue-600 font-semibold mb-1">Events</p>
                    <h2 class="text-3xl font-bold">Latest Events</h2>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">View all</a>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <?php if ($events): ?>
                    <?php foreach ($events as $event): ?>
                        <?php
                            $title = htmlspecialchars($event['title'], ENT_QUOTES, 'UTF-8');
                            $imageUrl = htmlspecialchars($event['image_url'] ?: 'https://placehold.co/600x400?text=Event', ENT_QUOTES, 'UTF-8');
                            $eventDate = htmlspecialchars(date('M d, Y', strtotime($event['event_date'])), ENT_QUOTES, 'UTF-8');
                            $location = htmlspecialchars($event['location'], ENT_QUOTES, 'UTF-8');
                            $description = htmlspecialchars($event['description'] ?? '', ENT_QUOTES, 'UTF-8');
                        ?>
                        <article class="bg-white rounded-xl shadow hover:shadow-lg transition-shadow overflow-hidden flex flex-col">
                            <img src="<?php echo $imageUrl; ?>" alt="<?php echo $title; ?>" class="h-40 w-full object-cover" />
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2"><?php echo $title; ?></h3>
                                <p class="text-sm text-gray-500 mb-1">📅 <?php echo $eventDate; ?></p>
                                <p class="text-sm text-gray-500 mb-3">📍 <?php echo $location; ?></p>
                                <p class="text-sm text-gray-600 flex-1 line-clamp-3"><?php echo $description; ?></p>
                                <div class="mt-4">
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">View Details</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-600">No events available yet. Please check back soon.</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="ranges" class="bg-white rounded-2xl shadow p-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <div>
                    <p class="text-blue-600 font-semibold mb-1">Shooting Ranges</p>
                    <h2 class="text-3xl font-bold">Find Ranges Near You</h2>
                    <p class="text-gray-600">Filter by state and district to quickly locate accredited shooting ranges.</p>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3 w-full lg:w-auto">
                    <div class="flex-1">
                        <label for="stateSelect" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                        <select id="stateSelect" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All States</option>
                            <?php foreach ($states as $state): ?>
                                <option value="<?php echo htmlspecialchars($state, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($state, ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="districtSelect" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                        <select id="districtSelect" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Districts</option>
                            <?php foreach ($allDistricts as $district): ?>
                                <option value="<?php echo htmlspecialchars($district, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($district, ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button id="filterButton" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">Filter</button>
                </div>
            </div>
            <div id="mapContainer" class="w-full h-[500px] rounded-xl overflow-hidden border border-gray-200">
                <div id="rangesMap" class="w-full h-full"></div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            <p>&copy; <?php echo date('Y'); ?> ShootingSports.in. All rights reserved.</p>
            <div class="space-x-4 mt-2 md:mt-0">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script>
        const districtLookup = <?php echo json_encode(array_map('array_keys', $districtLookup), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    </script>
    <script src="script.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo urlencode($googleMapsApiKey); ?>&callback=initMap" async defer></script>
</body>
</html>
