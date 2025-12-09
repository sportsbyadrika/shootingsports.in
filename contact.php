<?php
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us | ShootingSports.in</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="font-[Inter] bg-gray-50 text-gray-800">
    <?php include __DIR__ . '/navbar.php'; ?>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <section class="bg-white rounded-2xl shadow p-8 space-y-6">
            <div class="space-y-2">
                <p class="text-blue-600 font-semibold">Contact</p>
                <h1 class="text-4xl font-bold">We would love to hear from you</h1>
            </div>
            <p class="text-lg leading-relaxed text-gray-700">
                Have questions about events, ranges, or partnerships? Send us a message and our team will respond promptly.
            </p>
            <form class="grid gap-6" method="post" action="#">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                </div>
                <div>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">Send Message</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
