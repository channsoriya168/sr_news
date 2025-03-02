<template>
    <footer class="sticky bottom-0 px-4 py-6 overflow-hidden bg-gradient-to-b from-red-600 to-black">
        <div class="container relative flex flex-col items-center justify-between px-6 mx-auto md:flex-row">
            <!-- Left Side (Logo & Description) -->
            <div class="mb-4 text-center md:text-left md:mb-0">
                <div class="text-3xl font-bold">
                    <span class="text-red-300">SR</span><span class="text-white">NEWS</span>
                </div>
                <p class="mt-1 text-sm text-gray-300">Stay updated with the latest news.</p>
            </div>

            <!-- Center (Navigation Links) -->
            <div class="flex space-x-6 text-sm md:text-base">
                <Link href="#"
                    class="font-medium text-white no-underline transition-opacity opacity-65 hover:opacity-100">Home
                </Link>
                <Link href="#"
                    class="font-medium text-white no-underline transition-opacity opacity-65 hover:opacity-100">About
                </Link>
                <Link href="#"
                    class="font-medium text-white no-underline transition-opacity opacity-65 hover:opacity-100">Contact
                </Link>
                <Link href="#"
                    class="font-medium text-white no-underline transition-opacity opacity-65 hover:opacity-100">Privacy
                </Link>
            </div>

            <!-- Right Side (Social Media Links and Copyright) -->
            <div class="flex flex-col items-center mt-4 space-y-4 md:mt-0 md:space-y-0">
                <!-- Social Media Links -->
                <div class="flex space-x-4">
                    <a href="https://facebook.com" target="_blank" class="text-2xl text-gray-300 hover:text-blue-500">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="text-2xl text-gray-300 hover:text-blue-400">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="text-2xl text-gray-300 hover:text-pink-500">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" class="text-2xl text-gray-300 hover:text-blue-700">
                    </a>
                </div>

                <!-- Bottom Copyright -->
                <div class="relative text-sm text-center text-gray-400">
                    &copy; 2025 SRNEWS. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</template>
