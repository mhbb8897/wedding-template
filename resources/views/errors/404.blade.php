<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>404 - Halaman Tidak Ditemukan | MyWedd</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <style>
            @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
            @keyframes pulse-slow { 0%, 100% { opacity: 0.2; } 50% { opacity: 0.4; } }
            .animate-float { animation: float 3.5s ease-in-out infinite; }
            .animate-pulse-slow { animation: pulse-slow 4s ease-in-out infinite; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-900 text-slate-100 min-h-screen md:h-screen md:overflow-hidden flex flex-col justify-between selection:bg-rose-500 selection:text-white">

        <!-- Background Ambient Glow -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 bg-rose-500/15 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute -bottom-24 left-10 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Header -->
        <header class="relative z-10 w-full max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="h-10 w-10 bg-rose-500/20 rounded-xl flex items-center justify-center text-rose-500 ring-1 ring-rose-500/30 group-hover:scale-105 transition-transform">
                    <!-- Heart / Wedding Icon -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <span class="font-extrabold text-2xl tracking-tight text-white">My<span class="text-rose-500">Wedd</span></span>
            </a>
        </header>

        <!-- Main Content -->
        <main class="relative z-10 flex-1 flex items-center justify-center px-6 py-4 md:py-0">
            <div class="max-w-xl w-full text-center space-y-6">

                <!-- Graphic & Animated 404 Element -->
                <div class="relative mx-auto flex items-center justify-center">
                    <!-- Large Background Glow 404 Text -->
                    <span class="text-7xl sm:text-9xl font-black text-slate-800/80 tracking-widest select-none">
                        404
                    </span>

                    <!-- Floating Icon Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-gradient-to-tr from-rose-600 to-rose-400 text-white p-4 rounded-2xl shadow-xl shadow-rose-600/30 animate-float">
                            <!-- Search / Broken Ring Icon -->
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-medium">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </span>
                    Halaman Tidak Ditemukan
                </div>

                <!-- Text Headings -->
                <div class="space-y-2">
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                        Waduh, Langkah Anda Terlalu Far!
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 max-w-md mx-auto leading-relaxed">
                        Halaman yang Anda cari tidak tersedia, telah dihapus, atau mungkin alamat URL yang dimasukkan kurang tepat.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-rose-600 hover:bg-rose-500 text-white text-xs sm:text-sm font-semibold rounded-xl transition shadow-lg shadow-rose-600/30">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kembali ke Beranda
                    </a>

                    <button onclick="window.history.back()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 text-xs sm:text-sm font-semibold rounded-xl transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Halaman Sebelumnya
                    </button>
                </div>

            </div>
        </main>

        <!-- Footer -->
        <footer class="relative z-10 py-4 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} <span class="text-slate-400 font-medium">MyWedd</span>. Seluruh Hak Cipta Dilindungi.
        </footer>

    </body>
</html>