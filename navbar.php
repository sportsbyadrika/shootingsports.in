<?php
require_once __DIR__ . '/config.php';
?>
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <img src="/assets/logo.svg" alt="Shooting Sports" class="h-10 w-10 object-contain" />
                    <span class="font-bold text-xl text-gray-800">ShootingSports.in</span>
                </a>
            </div>
            <div class="hidden md:flex space-x-8 text-gray-700 font-medium">
                <a href="/" class="hover:text-blue-600 transition-colors">Home</a>
                <a href="/about.php" class="hover:text-blue-600 transition-colors">About Us</a>
                <a href="/contact.php" class="hover:text-blue-600 transition-colors">Contact Us</a>
            </div>
            <div class="md:hidden">
                <button id="menuToggle" aria-label="Toggle navigation" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div id="mobileMenu" class="md:hidden hidden border-t border-gray-200 bg-white">
        <a href="/" class="block px-4 py-3 text-gray-700 hover:bg-gray-50">Home</a>
        <a href="/about.php" class="block px-4 py-3 text-gray-700 hover:bg-gray-50">About Us</a>
        <a href="/contact.php" class="block px-4 py-3 text-gray-700 hover:bg-gray-50">Contact Us</a>
    </div>
</nav>
