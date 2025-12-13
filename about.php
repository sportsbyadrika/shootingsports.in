<?php
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us | ShootingSports.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="font-[Inter] bg-gray-50 text-gray-800">
    <?php include __DIR__ . '/navbar.php'; ?>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <section class="bg-white rounded-2xl shadow p-8 space-y-6">
            <div class="space-y-2">
                <p class="text-blue-600 font-semibold">Our Story</p>
                <h1 class="text-4xl font-bold">Empowering Shooting Sports in India</h1>
            </div>
            <p class="text-lg leading-relaxed text-gray-700">
                ShootingSports.in is a dedicated platform built to support India&apos;s growing community of shooting sports enthusiasts. We aim to connect athletes, coaches, and fans by providing timely event updates, verified range information, and resources that promote safety and excellence.
            </p>
            <p class="text-lg leading-relaxed text-gray-700">
                Our mission is to make shooting sports more accessible by using reliable data, modern technology, and secure design principles. From interactive maps to event discovery, every feature is crafted to deliver clarity and confidence to our users.
            </p>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="p-6 bg-blue-50 rounded-xl">
                    <h3 class="text-xl font-semibold mb-2">Community First</h3>
                    <p class="text-gray-700">We collaborate with clubs and federations to keep information accurate and current.</p>
                </div>
                <div class="p-6 bg-blue-50 rounded-xl">
                    <h3 class="text-xl font-semibold mb-2">Safety & Integrity</h3>
                    <p class="text-gray-700">Security best practices, verified listings, and transparent updates keep users protected.</p>
                </div>
                <div class="p-6 bg-blue-50 rounded-xl">
                    <h3 class="text-xl font-semibold mb-2">Nationwide Reach</h3>
                    <p class="text-gray-700">Discover shooting ranges and events from metropolitan hubs to emerging districts.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
