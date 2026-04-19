<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKM PSM</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/IC-PSM.jpg') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primaryDark: '#0f172a',   // deep navy
                        primary: '#1e3a8a',       // royal blue
                        primaryLight: '#3b82f6',  // blue accent
                        accent: '#f59e0b'         // gold
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-blue-50 text-gray-800">

    @include('components.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-primaryDark text-gray-300 mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-16">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- Tentang -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">
                        UKM PSM Polije
                    </h3>
                    <p class="text-sm leading-relaxed text-gray-400">
                        Unit Kegiatan Mahasiswa Paduan Suara Politeknik Negeri Jember
                        yang menjunjung tinggi harmoni, kreativitas, dan prestasi.
                    </p>
                </div>

                <!-- Navigasi -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">
                        Navigasi
                    </h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="/tentang" class="hover:text-white transition">Tentang</a></li>
                        <li><a href="/artikel" class="hover:text-white transition">Artikel</a></li>
                        <li><a href="/program" class="hover:text-white transition">Program</a></li>
                        <li><a href="/organisasi" class="hover:text-white transition">Organisasi</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">
                        Kontak
                    </h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Email: ukmpsm@polije.ac.id</li>
                        <li>Instagram: @ukmpsmpolije</li>
                        <li>Politeknik Negeri Jember</li>
                    </ul>
                </div>

                <!-- Google Maps (Lazy & Optimized) -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">
                        Lokasi Kami
                    </h3>

                    <div class="rounded-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps?q=Politeknik+Negeri+Jember&output=embed"
                            width="100%"
                            height="200"
                            style="border:0;"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>

            <!-- Bottom -->
            <div class="border-t border-gray-700 mt-12 pt-6 text-center text-sm text-gray-500">
                © {{ date('Y') }} UKM PSM Polije. All rights reserved.
            </div>

        </div>
    </footer>

    <!-- Lightweight Image Optimizer -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll("img").forEach(img => {

                img.setAttribute("loading", "lazy");
                img.setAttribute("decoding", "async");

                img.addEventListener("load", function() {
                    img.classList.add("loaded");
                    const shimmer = img.closest(".image-wrapper")?.querySelector(".shimmer");
                    if (shimmer) shimmer.remove();
                });

            });

        });
    </script>

</body>
</html>
